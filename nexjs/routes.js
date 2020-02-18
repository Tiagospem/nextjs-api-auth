const routes = require('next-routes');

module.exports = routes()
    .add('/', 'index')
    .add('/login', 'login')
    .add('/seguro', 'seguro')