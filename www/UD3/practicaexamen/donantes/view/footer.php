<?php


function footerDonantes()
    {
        $currentYear = date("Y");
        return <<<HTML
            <footer class="container-fluid  text-white position-fixed bottom-0 py-2 start-0 bg-info ">
                <div class="d-flex align-items-center">
                <div class="col-auto ms-4">
            <a  href="./index.php" class="btn btn-primary mt-1">Inicio    </a>
                </div>
                    <div class="col text-center">
                        <div>
                            <p class="mb-0 text-center">Copyright &copy; $currentYear 2024</p>
                        </div>
                    </div>
                </div>
            </footer>
            HTML;
    }