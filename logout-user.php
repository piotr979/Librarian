<?php

require 'includes/init.php';

Auth::logout();
Url::redirect('/librarian/index.php');