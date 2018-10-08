/* ===================================================
 *custom.js 
 * http://twitter.github.com/bootstrap/javascript.html#transitions
 * ===================================================
 * Copyright 2018 NCRTS
 * ========================================================== */


//single entity delete

$(document).on("click", ".delete-one", function(event) {
     event.preventDefault();
     var post_data = $(this).attr("id");
     var cnf = confirm("Are you sure  you want to delete this ?");
     if(cnf)
     {
          $.ajax({
              method: "POST",
              url: js_base_url+'admin/delete-single-entity',
              data: {
                  post_data : post_data
              },
              //dataType:'json',
              //beforeSend: function() {
                  //$("#singleproductdiv" + e).html('<div class="outerloaderbg"><div id="loader"></div></div>')
              //},
              success: function(data) {
                 if(data.message=="success")
                 {
                      location.reload();
                 }
                 else
                 {
                      alert(data.message);
                 }
              }
          })
     }
  });


//multiple entity delete

$(document).on("click", ".delete-multiple-row", function(event) {
event.preventDefault();
var table_name = $(this).attr('id');
//alert(table_name);

    var checkboxes = document.getElementsByName('multipleid[]');
    var vals = "";
    for (var i=0, n=checkboxes.length;i<n;i++) 
    {
        if (checkboxes[i].checked) 
        {
            vals += ","+checkboxes[i].value;
        }
    }
    if(vals)
    {
        var cnf = confirm("Are you sure you want to delete all ?");
        if(cnf)
        {
             $.ajax({
                  method: "POST",
                  url: js_base_url+'admin/delete-multiple-entity',
                  data: {
                      post_data : vals,
                      table_data : table_name
                  },
                  //dataType:'json',
                  //beforeSend: function() {
                      //$("#singleproductdiv" + e).html('<div class="outerloaderbg"><div id="loader"></div></div>')
                  //},
                  success: function(data) {
                     if(data.message=="success")
                     {
                          location.reload();
                     }
                     else
                     {
                          alert(data.message);
                     }
                  }
              })
        }
    }
    else
    {
        alert("Please select atleast one !!!");
    }
});

//active inactive records

$(document).on("click", ".change-status", function(event) {
    event.preventDefault();
    var post_data = $(this).attr("id");
     $.ajax({
          method: "POST",
          url: js_base_url+'admin/update-status',
          data: {
              post_data : post_data
          },
          //dataType:'json',
          //beforeSend: function() {
              //$("#singleproductdiv" + e).html('<div class="outerloaderbg"><div id="loader"></div></div>')
          //},
          success: function(data) {
             if(data.responce=='success')
             {
                //alert(data.status);
                if(data.status==0)
                {
                   $('#statusid'+data.row_id).html('<a class="btn btn-mini change-status" id="'+data.row_id+','+data.table_name+','+data.field_name+',0,'+data.condition_field+'" href="javascript:void(0)"><i class="icon-ok" aria-hidden="true" style="color:#17C200"></i> Active</a>');
                }
                else
                {
                    $('#statusid'+data.row_id).html('<a class="btn btn-mini change-status" id="'+data.row_id+','+data.table_name+','+data.field_name+',1,'+data.condition_field+'" href="javascript:void(0)"><i class="icon-remove" aria-hidden="true" style="color:#FF1F1F"></i> Inactive</a>');
                }
             }
             else
             {
                alert(data.message);
             }
          }
      })
  });




/*delete user*/

$(document).on("click", ".single-delete", function(event) {
 event.preventDefault();
  var checkboxes = document.getElementsByName('multipleid[]');
  var vals = "";
  for (var i=0, n=checkboxes.length;i<n;i++) 
  {
      if (checkboxes[i].checked) 
      {
          vals += ","+checkboxes[i].value;
      }
  }

  if(vals)
  {
        var cnf = confirm("Are you sure you want to delete users?");
        if(cnf)
        {
            $.ajax({
                method: "POST",
                url: js_base_url+'admin/single-delete',
                data: {
                    post_data : vals,
                    //table_name : table_name
                },
                //dataType:'json',
                //beforeSend: function() {
                    //$("#singleproductdiv" + e).html('<div class="outerloaderbg"><div id="loader"></div></div>')
                //},
                success: function(data) {
                     if(data=='success')
                     {
                        location.reload();
                     }
                }
            })
        }
  }
  else
  {
      alert('Please select atleast one user!');
  }

});



