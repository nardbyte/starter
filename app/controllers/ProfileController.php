<?php
// app/controllers/ProfileController.php
namespace App\Controllers;

use App\Models\User;

class ProfileController extends BaseController {
    protected $userModel;

    public function __construct() {
        parent::__construct();
        $this->userModel = new User();
    }

    public function index() {
        if (!isset($_SESSION['user_id'])) {
            header('Location: ' . $this->smarty->getTemplateVars('base_url') . 'login');
            exit();
        }

        $userId = $_SESSION['user_id'];
        $user = $this->userModel->findById($userId);
        $this->smarty->assign('user', $user);
        $this->render('pages/user/profile.tpl', 'Profile');
    }

    public function update() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_SESSION['user_id'])) {
            $userId = $_SESSION['user_id'];
            $first_name = filter_input(INPUT_POST, 'first_name', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $last_name = filter_input(INPUT_POST, 'last_name', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $country = filter_input(INPUT_POST, 'country', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $phone = filter_input(INPUT_POST, 'phone', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

            $avatar = $_FILES['avatar']['name'];
            $user = $this->userModel->findById($userId);

            $data = [
                'first_name' => $first_name,
                'last_name' => $last_name,
                'country' => $country,
                'phone' => $phone,
                'avatar' => $user['avatar'] // Mantener el avatar actual por defecto
            ];

            // Procesar la subida de la imagen del avatar
            if ($avatar && $_FILES['avatar']['error'] === UPLOAD_ERR_OK) {
                $fileTmpPath = $_FILES['avatar']['tmp_name'];
                $fileExtension = strtolower(pathinfo($avatar, PATHINFO_EXTENSION));
                $allowedfileExtensions = ['jpg', 'gif', 'png'];

                if (in_array($fileExtension, $allowedfileExtensions)) {
                    $newFileName = md5(time() . $avatar) . '.' . $fileExtension;
                    $uploadFileDir = __DIR__ . '/../../public/images/avatars/';
                    $dest_path = $uploadFileDir . $newFileName;

                    if ($this->resizeImage($fileTmpPath, $dest_path, 100, 100)) {
                        if ($user['avatar'] !== 'default_avatar.png') {
                            $old_avatar = $uploadFileDir . $user['avatar'];
                            if (file_exists($old_avatar)) {
                                unlink($old_avatar);
                            }
                        }
                        // Actualizar el nombre del avatar en los datos para la base de datos
                        $data['avatar'] = $newFileName;
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
            }

            // Actualizar el perfil del usuario en la base de datos con el nuevo nombre del avatar
            if ($this->userModel->updateProfile($userId, $data)) {
                $_SESSION['success'] = 'Profile updated successfully';
            } else {
                $_SESSION['error'] = 'There was an error updating your profile';
            }

            header('Location: /profile');
            exit;
        }
    }

    private function resizeImage($source, $destination, $width, $height) {
        list($original_width, $original_height) = getimagesize($source);
        $src = imagecreatefromstring(file_get_contents($source));
        $dst = imagecreatetruecolor($width, $height);

        if ($original_width > $original_height) {
            $src_x = ($original_width - $original_height) / 2;
            $src_y = 0;
            $src_w = $src_h = $original_height;
        } else {
            $src_x = 0;
            $src_y = ($original_height - $original_width) / 2;
            $src_w = $src_h = $original_width;
        }

        imagecopyresampled($dst, $src, 0, 0, $src_x, $src_y, $width, $height, $src_w, $src_h);

        switch (strtolower(pathinfo($destination, PATHINFO_EXTENSION))) {
            case 'jpg':
            case 'jpeg':
                $result = imagejpeg($dst, $destination);
                break;
            case 'gif':
                $result = imagegif($dst, $destination);
                break;
            case 'png':
                $result = imagepng($dst, $destination);
                break;
        }

        imagedestroy($src);
        imagedestroy($dst);

        return $result;
    }
}
