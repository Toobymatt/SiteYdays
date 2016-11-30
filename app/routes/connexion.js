var express = require('express');
var router = express.Router();


router.get('/', function(req, res, next) {
    res.render('connexion', { title: 'Connexion | Inscription' });
});

module.exports = router;