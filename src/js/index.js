$(document).ready(function () {
    var data = "";
    var id = 0;

    function Request(url) {
        return $.ajax({
            url: url,
            type: 'POST',
            async: false,
            dataType: 'json',
            success: function (respond) {
                if (typeof respond.error === 'undefined') {
                    data = respond;
                }
                else {
                    console.log('ОШИБКИ ОТВЕТА сервера: ' + respond.error);
                }
            },
            error: function (jqXHR, textStatus) {
                console.log('ОШИБКИ AJAX запроса: ' + textStatus);
            }
        });
    }

    $("#addTodoList").click(function () {

    });


    function readProject() {
        var url = 'src/controllers/projectController.php?command=read';

        Request(url);

        var html = "";

        data.forEach(function (item) {

            html += '<div id="' + item.id + '" class="container projectId ' + item.id + '">\n' +
                '    <div class="row">\n' +
                '        <div class="nav-h">\n' +
                '            <h3>\n' +
                '                <i class="glyphicon glyphicon-calendar"></i>\n' +
                '                &#8194;<div class="projectNameText">' + item.name + '</div>\n' +
                '            </h3>\n' +
                '            <h4>\n' +
                '                <a id="editProjectName" href="#">\n' +
                '                    <i class="glyphicon glyphicon-pencil"></i>\n' +
                '                </a>\n' +
                '                <a id="deleteProject" href="#">\n' +
                '                    <i class="glyphicon glyphicon-trash"></i>\n' +
                '                </a>\n' +
                '            </h4>\n' +
                '        </div>\n' +
                '\n' +
                '        <div class="typing-h">\n' +
                '            <div class="input-group">\n' +
                '                <span class="input-group-btn">\n' +
                '                    <button class="btn btn-success btnAddTask" type="button">\n' +
                '                        <i class="glyphicon glyphicon-plus"></i>\n' +
                '                    </button>\n' +
                '                </span>\n' +
                '                <input id="txtTaskText" type="text" class="form-control ' + item.id + '" placeholder="Start typing here to create a task...">\n' +
                '                <span class="input-group-btn">\n' +
                '                    <button class="btn btn-success btnAddTask" type="button">Add task</button>\n' +
                '                </span>\n' +
                '            </div>\n' +
                '        </div>\n' +
                '\n' +
                '        <div class="table-h">' +
                '<table class="tasks">' +
                '</table>' +
                '</div>' +
                '</div>' +
                '</div>' +
                '</br>' +
                '</br>';
        });

        $(".pojects").html(html);

        data = "";

        readTask();

    }

    readProject();

    function readTask() {
        var url = 'src/controllers/taskController.php?command=read';

        Request(url);

        var array = [];

        data.forEach(function (item) {
                array[item.project_id] += '<tr id="'+item.id+'" class="'+item.priority+'">\n' +
                    '    <td class="td-1"><input type="checkbox" name="check-me" value="somevalue"></td>\n' +
                    '    <td class="td-2"><div id="divTaskText">'+item.text+'</div></td>\n' +
                    '    <td class="td-3">\n' +
                    '        <a id="editTaskProirity">\n' +
                    '            <i class="glyphicon glyphicon-sort"></i>\n' +
                    '        </a>\n' +
                    '        <a id="editTaskText">\n' +
                    '            <i class="glyphicon glyphicon-pencil"></i>\n' +
                    '        </a>\n' +
                    '        <a id="deleteTask">\n' +
                    '            <i class="glyphicon glyphicon-trash"></i>\n' +
                    '        </a>\n' +
                    '    </td>\n' +
                    '    </tr>';
        });

        data = "";

        array.forEach(function (item, key){
            $('div#'+key+' table.tasks').html(item);
            //console.log(key +" :" + item);
        });
    }

    $("div.projectId").click(function () {
        id = $(this).attr('id');
    });

    function deleteTask(id) {
        var url = 'src/controllers/taskController.php?command=delete&id='+id;
        Request(url);

        readTask();
    }

    $(".tasks tr .glyphicon.glyphicon-trash").click(function () {
        $(".tasks tr").click(function () {
            id = $(this).attr('id');
            console.log(id);
            deleteTask(id);
        });
    });

    $(".btnAddTask").click(function () {

        $("div.projectId").click(function () {
            id = $(this).attr('id');
        });

        createTask($(".form-control."+id).val(), id);
    });

    function createTask(text, id) {

        var url = 'src/controllers/taskController.php?command=create&text='+text+'&id='+id;

        Request(url);

        $(".form-control."+id).val("");

        readTask();
    }

});

