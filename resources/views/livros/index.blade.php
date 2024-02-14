<?php

header('Content-Type: application/json');

if(isset($error))
    echo json_encode([$error], JSON_UNESCAPED_UNICODE, JSON_PRETTY_PRINT);


if(isset($success))
    echo json_encode([$success], JSON_UNESCAPED_UNICODE, JSON_PRETTY_PRINT);


if(isset($livros))
    echo json_encode($livros, JSON_UNESCAPED_UNICODE, JSON_PRETTY_PRINT);