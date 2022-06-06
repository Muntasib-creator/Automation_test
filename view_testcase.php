<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <h4>viewing page of <?php echo $_GET["id"];?></h4>
    <div id="action_container">
        <table style="border-style: groove; margin: 10px 20px 20px 10px;}">
            <tr>
                <td><input value="att_name" type="text" name="" id=""></td>
                <td><input value="element parameter" type="text" name="" id=""></td>
                <td><textarea name="" id="">att_val</textarea></td>
            </tr>
            <tr>
                <td><input value="click" type="text" name="" id=""></td>
                <td><input value="selenium action" type="text" name="" id=""></td>
                <td><textarea name="" id="">click</textarea></td>
            </tr>
        </table>
    </div>
    <button value="Add" onclick="return add_action()">Add</button>
    <script>
    function add_action() {
        table_text = '<table style="border-style: groove;  margin: 10px 20px 20px 10px;}">\
            <tr>\
                <td><input value="att_name" type="text" name="" id=""></td>\
                <td><input value="element parameter" type="text" name="" id=""></td>\
                <td><textarea name="" id="">att_val</textarea></td>\
            </tr>\
            <tr>\
                <td><input value="click" type="text" name="" id=""></td>\
                <td><input value="selenium action" type="text" name="" id=""></td>\
                <td><textarea name="" id="">click</textarea></td>\
            </tr>\
        </table>'
        let ac_container = document.getElementById("action_container");
        ac_container.innerHTML += table_text
    }
    </script>
</body>

</html>