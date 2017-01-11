<!-- Footer -->
<footer id="footer">
</footer>
<!-- Latest compiled and minified JavaScript -->
<script src="js/jquery.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"
        integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa"
        crossorigin="anonymous"></script>
<script>
    $('.but').click(function () {
        $('.exp').slideUp('medium')
        $('.exp' + $(this).attr('data-id')).slideDown('5s');
    });

    $('.exp2').show();
    $('.exp1').hide();
    /* Fin du personnel */
</script>
</body>
</html>
