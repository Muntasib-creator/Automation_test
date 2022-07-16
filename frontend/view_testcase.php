<?php 
    include '../backend/db.php';
    session_start();
    if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin']!=true){
        header("location: login.php");
        exit;
    }
    if($conn->connect_error){
        die("DB Connection Failed " . $conn->connect_error);
    }
    $tc_id = $_GET["id"];
    $q1 = "SELECT * FROM actions WHERE tc_id = '$tc_id' ORDER BY `actions`.`action_seq` ASC";
    $res = mysqli_query($conn, $q1);
    $list_of_actions = mysqli_fetch_all($res,MYSQLI_ASSOC);
    $list_of_actions = json_encode($list_of_actions);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View</title>
    <style>
        input#action_name { 
            text-align: center; 
            width:50%;
        }
        input{
            width:90%;
        }
        textarea{
            width: 90%;
            
        }
        
    </style>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    
</head>

<body>
    <?php include "nav.php"; ?>
    <label for="cars">Choose an Action</label>
    <select name="cars" id="action_set">
    </select>
    <button onclick="return add_action()">Add</button>
    <button style="float:right" id="save_actions">Save</button>
    <button style="float:right" id="run">Run</button>
    <button style="float:right" id="debug">Debug</button>
    <div id="action_container">
    </div>

    <script>
    action_container = document.getElementById("action_container");
    action_container.addEventListener("click", del_action);
    document.getElementById("save_actions").addEventListener("click", save_actions);
    document.getElementById("run").addEventListener("click", run);
    document.getElementById("debug").addEventListener("click", debug);
    const urlParams = new URLSearchParams(window.location.search);
    const data  = JSON.parse('<?php echo $list_of_actions; ?>');
    const tc_id  = JSON.parse(urlParams.get('id'));
    console.log(data);
    
    let actions = new Array();
    for (let i = 0; i < data.length; i++) {
        if(actions[data[i]["action_seq"]] == undefined){
            actions[data[i]["action_seq"]] = {
                action_name : data[i]["action_name"],
                action_disable : data[i]["action_disable"],
                rows: []
            };
            actions[data[i]["action_seq"]]["rows"][data[i]["row_seq"]] = {
                field: data[i]["field"],
                sub_field: data[i]["sub_field"],
                value: data[i]["value"],
            }
        }
        else{
            actions[data[i]["action_seq"]]["rows"][data[i]["row_seq"]] = {
                field: data[i]["field"],
                sub_field: data[i]["sub_field"],
                value: data[i]["value"],
            }
        }
        
    };
    console.log(actions);
    for(i=1;i<actions.length;i++){
        if(actions[i]["action_disable"] == "0"){
            check = "checked";
        }
        else{
            check = "unchecked";
        }
        table_text = `<table style="border-style: groove;  margin: 10px 20px 20px 10px;}">
            <thead><tr><th colspan="5">Action-${i}</th></tr>
            <tr><th><input type="checkbox" ${check} id="disable"></th><th colspan="3"><input value="${actions[i]["action_name"]}" id="action_name"></th><th><button test="del_action">delete</button></th></tr></thead>
            <tbody>`;
        for(j=1;j<actions[i]["rows"].length;j++){
            table_text += '<tr><td width="5%"><button test="add_row">add</button></td>';
            table_text += `<td width="25%" test="field"><input value="${actions[i]["rows"][j]["field"]}" type="text" name="" id=""></td>`
            table_text += `<td width="20%" test="sub_field"><input value="${actions[i]["rows"][j]["sub_field"]}" type="text" name="" id=""></td>`
            table_text += `<td width="45%" test="value"><textarea name="" id="">${actions[i]["rows"][j]["value"]}</textarea></td>`
            table_text += '<td width="5%"><button test="del_row">del</button></td></tr>';
        }
        table_text += `</tbody></table>`;
        var div = document.createElement('div');
        div.innerHTML = table_text.trim();
        action_container.appendChild(div.firstChild);
    }
    
    action_db = {
        go_to_link:[
            ["go to link", "selenium action", "https://demo.zeuz.ai/web/level/one/scenerios/login"],
        ],
        click:[
            ["att_name", "element parameter", "att_val"],
            ["click", "selenium action", "click"],
        ],
        enter_text:[
            ["att_name", "element parameter", "att_val"],
            ["text", "selenium action", "val"],
        ],
        
    }
    const new_row = `<tr><td width="5%"><button test="add_row">add</button></td>
        <td width="25%" test="field"><input value="" type="text" name="" id=""></td>
        <td width="20%" test="sub_field"><input value="" type="text" name="" id=""></td>
        <td width="45%" test="value"><textarea name="" id=""></textarea></td>
        <td width="5%"><button test="del_row">del</button></td></tr>
        `
    let select = document.getElementById("action_set");
    action_datasets = {}
    for (var key of Object.keys(action_db)) {
        var option = document.createElement('option');
        _key = key.replaceAll("_", " ");
        _key = _key.charAt(0).toUpperCase() + _key.toLocaleLowerCase().substring(1)
        option.innerText = _key;
        option.setAttribute("value", key);
        select.appendChild(option);

        action = action_db[key];
        action_text = `<table style="border-style: groove;  margin: 10px 20px 20px 10px;}">
            <thead><tr><th colspan="5">Action-${i}</th></tr>
            <tr><th><input type="checkbox" checked id="disable"></th><th colspan="3"><input value="None" id="action_name"></th><th><button test="del_action">delete</button></th></tr></thead>
            <tbody>`;
        for(i=0;i<action.length;i++){
            action_text += '<tr><td width="5%"><button test="add_row">add</button></td>';
            action_text += `<td width="25%" test="field"><input value="${action[i][0]}" type="text" name="" id=""></td>`
            action_text += `<td width="20%" test="sub_field"><input value="${action[i][1]}" type="text" name="" id=""></td>`
            action_text += `<td width="45%" test="value"><textarea name="" id="">${action[i][2]}</textarea></td>`
            action_text += '<td width="5%"><button test="del_row">del</button></td></tr>';
        }
        action_text += `</tbody></table>`;
        action_datasets[key] = action_text
    }
    
    function add_action() {
        table_text = action_datasets[document.getElementById("action_set").value];
        var div = document.createElement('div');
        div.innerHTML = table_text.trim();
        action_container.appendChild(div.firstChild);
    }

    function del_action(e) {
        if(e.target.tagName == "BUTTON" && e.target.getAttribute("test") == "del_action"){
            element=e.target.parentElement.parentElement.parentElement.parentElement;
            element.parentElement.removeChild(element);
        }
        else if(e.target.tagName == "BUTTON" && e.target.getAttribute("test") == "del_row"){
            tr=e.target.parentElement.parentElement;
            tbody = tr.parentElement;
            table = tbody.parentElement;
            tr.parentElement.removeChild(tr);

            if(tbody.childElementCount ==0){
                table.parentElement.removeChild(table);
            }
        }
        else if(e.target.tagName == "BUTTON" && e.target.getAttribute("test") == "add_row"){
            let table = document.createElement('table');
            table.innerHTML = new_row.trim();
            new_elem = table.firstChild.firstChild;
            tr = e.target.parentElement.parentElement;
            tbody = tr.parentElement;
            tbody.insertBefore(new_elem,tr);
        }
        
    }
    function save_actions(e){
        query = [];
        for(i=0;i<action_container.childElementCount;i++){
            tbody = action_container.children[i].getElementsByTagName("tbody")[0];
            action_name = action_container.children[i].getElementsByTagName("thead")[0].getElementsByTagName("input")[1].value;
            checked = action_container.children[i].getElementsByTagName("thead")[0].getElementsByTagName("input")[0].checked;
            if(checked==false){
                disable = "1";
            }
            else{
                disable = "0";
            }
            for(j=0;j<tbody.childElementCount;j++){
                tds = tbody.children[j].children;
                q_row = [null, tc_id, i+1, action_name, disable, j+1];
                for(k=0;k<tds.length;k++){
                    if(tds[k].getAttribute("test") == "field"){
                        q_row[6] = tds[k].getElementsByTagName("input")[0].value;
                    }
                    else if(tds[k].getAttribute("test") == "sub_field"){
                        q_row[7] = tds[k].getElementsByTagName("input")[0].value;
                    }
                    else if(tds[k].getAttribute("test") == "value"){
                        q_row[8] = tds[k].getElementsByTagName("textarea")[0].value;
                    }
                }
            query.push(q_row);
            }
        }
        console.log(query);
        query = JSON.stringify(query);
        url = `/automation_test/backend/save_actions.php?tc_id=${tc_id}&query=${query}`
        // window.location = url;
        fetch(url);
    }
    function debug(e){
        url = `/automation_test/backend/debug_run.php?tc_id=[${tc_id}]&run_status=debug`;
        //window.location = url;
        fetch(url);
    }
    function run(e){
        url = `/automation_test/backend/debug_run.php?tc_id=[${tc_id}]&run_status=run`;
        //window.location = url;
        fetch(url);
    }
    </script>
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    
</body>

</html>