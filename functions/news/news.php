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
            padding: 5px;
            text-align: center;
            background-color: transparent;
            border: solid 1px #c3c3c3;
        }

        #panel {
            padding: 50px;
            display: none;
        }
    </style>
</head>
<body>

<div id="flip">News</div>
<div id="panel">

    <a class="twitter-timeline" href="https://twitter.com/Craxee89?ref_src=twsrc%5Etfw">Tweets by Craxee89</a> <script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>




</div>

</body>
</html>
