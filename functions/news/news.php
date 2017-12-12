<!DOCTYPE html>
<html>
<head>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script>
        $(document).ready(function(){
            $("#flip").click(function(){
                $("#panel").slideToggle("slow");
            });
        });
    </script>

    <style>
        #panel, #flip {
            padding: 10px;
            text-align: center;
            background-color: transparent;
            border: solid 1px #c3c3c3;
        }

        #panel {
            padding: 400px;
            display: none;
        }
    </style>
</head>
<body>

<div id="flip">Click to slide the panel down or up</div>
<div id="panel">Hello world!</div>

</body>
</html>
