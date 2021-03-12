<?php

use JM\YouThumb\Session;


beforeEach(function () {
    if ((session_status() === PHP_SESSION_ACTIVE)) {
        session_destroy();
    }
});

test('Not started sessions are detected.', function () {
    $session = new Session();
    
    expect($session->hasStarted())->toBeFalse();
});

test('Started sessions are detected.', function () {
    $session = new Session();
    $session->start();
    
    expect($session->hasStarted())->toBeTrue();
});


test('Ended sessions are detected.', function () {
    $session = new Session();
    $session->start();
    
    
    expect($session->hasStarted())->toBeTrue();
});

test('Set/Has/Get/Forget are working correctly', function () {
    $session = new Session();
    $session->start();
    
    $key = 'mykey';
    $val = 'myval';
    
    expect($session->has($key))->toBeFalse();
    
    $session->set($key, $val);
    
    expect($session->has($key))->toBeTrue();
    expect($session->get($key))->toEqual($val);
    
    $session->forget($key);
    
    expect($session->has($key))->toBeFalse();
});

test('getAll returns all session values', function () {
    $session = new Session();
    $session->start();
    
    $key = 'mykey';
    $val = 'myval';
    
    $session->set($key, $val);
    
    expect($session->getAll())->toEqual([
      $key => $val
    ]);
});
