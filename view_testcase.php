<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <!-- <h4>viewing page of <?php echo $_GET["id"];?></h4> -->
    <div id="action_container">
        <table style="border-style: groove; margin: 10px 20px 20px 10px;}">
            <thead>
                <button test="del" onclick="return del_action()">delete</button>
            </thead>
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
    <button onclick="return add_action()">Add</button>
    <script>
    // let button = document.getElementsByTagName("button").add
    // buttons = $x("//button[@test='del']")
    var xpathResult = document.evaluate(
        "//button[@test='del']", document, null, XPathResult.UNORDERED_NODE_ITERATOR_TYPE, null
        
    );
    var results = [];
    var node;
   while ((node = xpathResult.iterateNext()) != null) {
     results.push(node);
   }
    for (let i = 0; i < 10; i++) {
        console.log(i);
    }
    var div = document.createElement('div');
  div.innerHTML = htmlString.trim();

  // Change this to div.childNodes to support multiple top-level nodes.
  return div.firstChild;

    function add_action() {
        table_text = '<table style="border-style: groove;  margin: 10px 20px 20px 10px;}">\
            <button test="del" onclick="return del_action()">delete</button>\
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

    function del_action(e) {
        // let ac_container = document.getElementById("action_container");
        // ac_container.innerHTML += table_text
        e.preventDefault();
        console.log(e.target)
    }
    </script>
</body>

</html>