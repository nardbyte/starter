<footer class="footer fixed-bottom border-top mt-auto py-3 bg-dark">
    <div class="container text-center">
        <span class="text-white d-block mb-2">
            &copy; {$sitename} {$current_year} v{$version|escape}
        </span>
        <span class="text-white d-block" style="font-size: 0.6em;">
            Page loaded in {$generation_time} sec
        </span>
        <span class="text-white d-block" style="font-size: 0.6em;">
            Memory used: {$usage|escape}
        </span>
    </div>
</footer>

<script src="{$base_url}vendor/twbs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
