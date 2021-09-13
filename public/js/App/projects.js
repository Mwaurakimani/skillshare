/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!**************************************!*\
  !*** ./resources/js/App/projects.js ***!
  \**************************************/
//set up ajax
$.ajaxSetup({
  headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  }
}); //exclude skill

window.exclude_skill_fun = function () {
  var elem = $(this);
  var skill_id = elem.parent().attr('data-id');
  var project_id = $('#project_form').attr('data-id');
  $.ajax({
    type: 'POST',
    url: '/removeSkill',
    dataType: 'json',
    data: {
      skill_id: skill_id,
      project_id: project_id
    },
    success: function success(data) {
      var status = data.status_code;

      if (status == 1) {
        elem.parent().remove();
      } else if (status == 0) {
        elem.parent().remove();
      } else {
        console.log(data);
      }
    },
    error: function error(xhr) {
      console.log(xhr.responseJSON);
    }
  });
}; //delete project


window.delete_project = function () {
  var delete_this = confirm("Are you sure you wish to delete this project?");

  if (!delete_this) {
    return false;
  }

  var elem = $(event.currentTarget);
  var project = elem.parent().parent().parent().parent();
  var project_id = project.attr('data-id');
  $.ajax({
    type: 'DELETE',
    url: '/project/' + project_id,
    dataType: 'json',
    data: {
      id: project_id,
      _methode: 'DELETE'
    },
    success: function success(data) {
      project.fadeOut(400, function () {
        project.remove();
      });
    },
    error: function error(xhr) {
      console.log(xhr.responseJSON.message);
    }
  });
  return false;
}; //filter skills


$('#skill_input_selector').on('keyup', function () {
  var elem = $('#skill_input_selector');
  var skill = elem.val();
  $.ajax({
    type: 'POST',
    url: '/searchSkill',
    dataType: 'json',
    data: {
      skill: skill
    },
    success: function success(data) {
      var list_elem = $('#skills');
      list_elem.text('');
      var list = data.msg;
      $(list).each(function (index, value) {
        list_elem.append("" + "<option data-id='" + value.id + "' value='" + value.name + "'>" + value.name + "</option>");
      });
    },
    error: function error(xhr) {
      console.log(xhr.responseJSON.message);
    }
  });
}); //add skill to project

$('#add_skill_to_project').on('click', function (e) {
  e.preventDefault();
  var skill_name = $('#skill_input_selector').val();
  var skill_id = $($('#skills').children()[0]).attr('data-id');
  var project_id = $('#project_form').attr('data-id');

  if (skill_id == undefined) {
    alert('No skill selected');
  }

  $.ajax({
    type: 'POST',
    url: '/addSkillToProject',
    dataType: 'json',
    data: {
      skill_name: skill_name,
      skill_id: skill_id,
      project_id: project_id
    },
    success: function success(data) {
      var status = data.status_code;

      if (status == 1) {
        $('<p data-id="' + data.skill.id + '">' + ' ' + data.skill.name + ' <span class="exclude_skill">X</span>' + '</p>').appendTo('.skill-lister').find('span').on('click', exclude_skill_fun);
      } else if (status == 0) {
        console.log("Exists here");
      } else {
        console.log(data);
      }
    },
    error: function error(xhr) {
      console.log(xhr.responseJSON);
    }
  });
}); //assign exclude skill

$('.exclude_skill').on('click', exclude_skill_fun);
$('.btn-set-complete-Project button').on('click', function () {
  var elem = $('#project_form');
  var project_id = elem.attr('data-id');
  var confirmation = confirm("Are you sure you want to set this project as complete?Once Set you cannot revert changes");

  if (confirmation == false) {
    return;
  }

  $.ajax({
    type: 'POST',
    url: '/project/complete',
    data: {
      'project_id': project_id
    },
    success: function success(data) {
      if (data.data == true) {
        $('.rating-card').css('display', 'block');
      }
    },
    error: function error(data) {
      console.log(data);
    }
  });
});
/******/ })()
;