<?php
// app/controllers/ProfileController.php
namespace App\Controllers;

use App\Models\User;

class ProfileController extends BaseController {
    private $userModel;

    public function __construct() {
        parent::__construct();
        $this->userModel = new User();
    }

    public function index() {
        if (!isset($_SESSION['user_id'])) {
            header('Location: /login');
            exit;
        }

        $user = $this->userModel->findById($_SESSION['user_id']);
        $this->smarty->assign('user', $user);
        $this->render('pages/user/profile.tpl', 'Profile');
    }

    public function update() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_SESSION['user_id'])) {
            $first_name = filter_input(INPUT_POST, 'first_name', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $last_name = filter_input(INPUT_POST, 'last_name', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $country = filter_input(INPUT_POST, 'country', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $phone = filter_input(INPUT_POST, 'phone', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $avatar = $_FILES['avatar']['name'];

            $user = $this->userModel->findById($_SESSION['user_id']);
            $data = [
                'first_name' => $first_name,
                'last_name' => $last_name,
                'country' => $country,
                'phone' => $phone,
                'avatar' => $user['avatar'] // Mantener el avatar actual por defecto
            ];

            // Verifica si se ha subido un nuevo avatar
            if ($avatar && $_FILES['avatar']['error'] === UPLOAD_ERR_OK) {
                // Verificar el tipo de archivo
                $file_type = mime_content_type($_FILES['avatar']['tmp_name']);
                $allowed_types = ['image/png', 'image/jpeg', 'image/gif'];

                if (in_array($file_type, $allowed_types)) {
                    $extension = pathinfo($avatar, PATHINFO_EXTENSION);
                    $random_filename = md5(uniqid(rand(), true)) . '.' . $extension;
                    $target = __DIR__ . '/../../public/images/avatars/' . $random_filename;

                    // Redimensionar la imagen a 100x100 píxeles usando GD
                    if ($this->resizeImage($_FILES['avatar']['tmp_name'], $target, 100, 100)) {
                        // Eliminar la imagen anterior si no es la predeterminada
                        if ($user['avatar'] !== 'default_avatar.png') {
                            $old_avatar = __DIR__ . '/../../public/images/avatars/' . $user['avatar'];
                            if (file_exists($old_avatar)) {
                                unlink($old_avatar);
                            }
                        }

                        // Actualizar el nombre del avatar en los datos para la base de datos
                        $data['avatar'] = $random_filename;
                    } else {
                        $_SESSION['error'] = 'Error resizing image.';
                        header('Location: /profile');
                        exit;
                    }
                } else {
                    $_SESSION['error'] = 'Invalid file type. Only PNG, JPG, and GIF are allowed.';
                    header('Location: /profile');
                    exit;
                }
            } elseif ($_FILES['avatar']['error'] !== UPLOAD_ERR_NO_FILE) {
                $_SESSION['error'] = 'File upload error: ' . $_FILES['avatar']['error'];
                header('Location: /profile');
                exit;
            }

            // Actualizar el perfil del usuario en la base de datos con el nuevo nombre del avatar
            if ($this->userModel->updateProfile($_SESSION['user_id'], $data)) {
                $_SESSION['success'] = 'Profile updated successfully';
            } else {
                $_SESSION['error'] = 'There was an error updating your profile';
            }

            header('Location: /profile');
            exit;
        }
    }

    private function resizeImage($source, $destination, $final_width, $final_height) {
        if (!file_exists($source)) {
            return false;
        }

        list($original_width, $original_height) = getimagesize($source);
        $aspect_ratio = $original_width / $original_height;

        if ($aspect_ratio >= 1) {
            // La imagen es más ancha que alta
            $new_width = $final_width * $aspect_ratio;
            $new_height = $final_height;
        } else {
            // La imagen es más alta que ancha
            $new_width = $final_width;
            $new_height = $final_height / $aspect_ratio;
        }

        // Crear una nueva imagen a partir del original
        $image_p = imagecreatetruecolor($final_width, $final_height);
        $extension = pathinfo($source, PATHINFO_EXTENSION);

        switch ($extension) {
            case 'png':
                $image = imagecreatefrompng($source);
                break;
            case 'jpeg':
            case 'jpg':
                $image = imagecreatefromjpeg($source);
                break;
            case 'gif':
                $image = imagecreatefromgif($source);
                break;
            default:
                return false;
        }

        if (!$image) {
            return false;
        }

        // Calcular las coordenadas de recorte
        $x_offset = ($new_width - $final_width) / 2;
        $y_offset = ($new_height - $final_height) / 2;

        // Redimensionar y recortar la imagen al centro
        if (!imagecopyresampled($image_p, $image, 0, 0, $x_offset, $y_offset, $final_width, $final_height, $original_width, $original_height)) {
            return false;
        }

        // Guardar la imagen en el destino
        switch ($extension) {
            case 'png':
                $result = imagepng($image_p, $destination);
                break;
            case 'jpeg':
            case 'jpg':
                $result = imagejpeg($image_p, $destination);
                break;
            case 'gif':
                $result = imagegif($image_p, $destination);
                break;
            default:
                return false;
        }

        imagedestroy($image_p);
        imagedestroy($image);

        return $result;
    }
}
