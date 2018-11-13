# back REST api

// simple route

// get the user 1
// Router::get('/api/users/1, function() {});

// create a new user with a request body
// Router::post('/api/users', function() {});

// update the user 1 with a request body
// Router::put('/api/users/1', function() {});

// delete all users
// Router::delete('/api/users', function() {});

// delete the user 1
// Router::delete('/api/users/1', function() {});

// for create and delete, if id 1 does not exist return 404

// nested route

// get all messages of the user 1
// Router::get('/api/users/1/messages, function() {})

// create a message of the user 1 with the request body
// Router::post('/api/users/1/messages, function() {})

// update the message 2 of the user 1 with the request body
// Router::put('/api/users/1/messages/2, function() {})

// delete the message 2 of the user 1
// Router::delete('/api/users/1/messages/2, function() {})
