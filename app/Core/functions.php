<?php

function dd(...$vars)
{
  echo '<pre>';
  echo '<p>Debug Output:</p>';
  foreach ($vars as $var) {
    echo '<div 
    style="background-color: #e7e7e7; 
    padding: 1rem;
    border-radius: .3rem;
    margin-block: 1rem
    ">';
    var_dump($var);
    echo '</div>';
  }

  $backtrace = debug_backtrace()[0];
  echo '<p>File: ' . $backtrace['file'] . '</p>';
  echo '<p>Line: ' . $backtrace['line'] . '</p>';
  echo '</pre>';
  die();
}
