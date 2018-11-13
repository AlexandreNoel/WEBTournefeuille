<?php
namespace Router;

describe('Router', function() {
    it('should handle a get request', function() {
        $_SERVER['REQUEST_METHOD'] = 'GET';
        $_SERVER['REQUEST_URI'] = '/api/users/1/messages/2';
        Router::get('/api/users/{}/messages/{}', function($request) {
            return $request;
        });

        $request = Router::execute();

        expect($request->params)->toBe(['1', '2']);
    });

    it('should handle a post request', function() {
        $_SERVER['REQUEST_METHOD'] = 'POST';
        $_SERVER['REQUEST_URI'] = '/api/users/12/messages/22';
        allow('file_get_contents')->toBeCalled()->andReturn('{"text": "awesome text"}');
        Router::post('/api/users/{}/messages/{}', function($request) {
            return $request;
        });

        $request = Router::execute();

        expect($request->params)->toBe(['12', '22']);
        expect($request->body->text)->toBe('awesome text');
    });

    it('should handle a put request', function() {
        $_SERVER['REQUEST_METHOD'] = 'PUT';
        $_SERVER['REQUEST_URI'] = '/api/users/24/messages/89';
        allow('file_get_contents')->toBeCalled()->andReturn('{"text": "awesome update"}');
        Router::put('/api/users/{}/messages/{}', function($request) {
            return $request;
        });

        $request = Router::execute();

        expect($request->params)->toBe(['24', '89']);
        expect($request->body->text)->toBe('awesome update');
    });

    it('should handle a delete request', function() {
        $_SERVER['REQUEST_METHOD'] = 'DELETE';
        $_SERVER['REQUEST_URI'] = '/api/users/119/messages/31';
        Router::delete('/api/users/{}/messages/{}', function($request) {
            return $request;
        });

        $request = Router::execute();

        expect($request->params)->toBe(['119', '31']);
    });

    it('should set status code to 404 when no route found', function() {
        $_SERVER['REQUEST_METHOD'] = 'GET';
        $_SERVER['REQUEST_URI'] = '/bad/url';

        Router::execute();

        expect(http_response_code())->toBe(404);
    });
});
