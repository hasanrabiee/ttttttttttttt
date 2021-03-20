<?php


function flash($message, $type){

    session()->flash('message', $message);
    session()->flash('type', $type);
}
