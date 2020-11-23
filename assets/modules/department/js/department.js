function refreshScheme4() {
  let employees_count = jQuery('input[name="employees_count"]').val();
  let container = jQuery('#scheme4_content');

  jQuery.ajax({
    url: '/manager/index.php?a=112&id=3',
    type: 'POST',
    data: 'tabAction=refreshScheme4&employees_count=' + employees_count,
    success: function (result) {
      container.html(result);
    }
  });
}

function refreshScheme5() {
  let salary_count = jQuery('input[name="salary_count"]').val();
  let container = jQuery('#scheme5_content');

  jQuery.ajax({
    url: '/manager/index.php?a=112&id=3',
    type: 'POST',
    data: 'tabAction=refreshScheme5&salary_count=' + salary_count,
    success: function (result) {
      container.html(result);
    }
  });
}