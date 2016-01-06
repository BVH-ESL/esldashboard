<html>
    <head>
        <script src="jquery-1.8.3.min.js" type="text/javascript"></script>
        <script type="text/javascript">
            $.getJSON("jsonfile/test.json", function (json) {
                console.log(json); // this will show the info it in firebug console
            });
        </script>
    </head>
</html>