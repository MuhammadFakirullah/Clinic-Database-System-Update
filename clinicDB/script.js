$(document).ready(function() {
  // Call fetchData function
  fetchData();

  // Initialize DataTable with column definitions
  let table = $("#myTable").DataTable({
    columns: [
      { data: "id" }, // ID column
      { data: "description" }, // Description column
      {
        data: "image",
        render: function(data, type, row) {
          // Display the image in the Image column
          return '<img src="uploads/' + data + '" style="width:50px;height:50px;border:2px solid gray;border-radius:8px;object-fit:cover">';
        },
      },
      {
        data: null,
        render: function(data, type, row) {
          // Action buttons in the Action column
          return '<button type="button" class="btn editBtn" value="' + data.id + '"><i class="fa-solid fa-pen-to-square fa-xl"></i></button>' +
            '<button type="button" class="btn deleteBtn" value="' + data.id + '"><i class="fa-solid fa-trash fa-xl"></i></button>' +
            '<input type="hidden" class="delete_image" value="' + data.image + '">';
        },
      },
    ],
  });

  // Function to fetch data from the database
  function fetchData() {
    $.ajax({
      url: "server.php?action=fetchData",
      type: "POST",
      dataType: "json",
      success: function(response) {
        table.clear().rows.add(response.data).draw();
      },
    });
  }
  
  // Function to handle file input change and update image preview for new user
  $("#insertForm .image").on("change", function() {
    var input = this;
    if (input.files && input.files[0]) {
      var reader = new FileReader();
      reader.onload = function(e) {
        $("#insertForm .preview_img").attr("src", e.target.result);
      };
      reader.readAsDataURL(input.files[0]);
    }
  });

  // Function to handle file input change and update image preview for editing user data
  $("#editForm .image").on("change", function() {
    var input = this;
    if (input.files && input.files[0]) {
      var reader = new FileReader();
      reader.onload = function(e) {
        $("#editForm .preview_img").attr("src", e.target.result);
      };
      reader.readAsDataURL(input.files[0]);
    }
  });

  // Function to insert data to the database using a modal
  $("#insertForm").on("submit", function(e) {
    $("#insertBtn").attr("disabled", "disabled");
    e.preventDefault();
    $.ajax({
      url: "server.php?action=insertData",
      type: "POST",
      data: new FormData(this),
      contentType: false,
      cache: false,
      processData: false,
      success: function(response) {
        var response = JSON.parse(response);
        if (response.statusCode == 200) {
          $("#addUserModal").modal("hide");
          $("#insertBtn").removeAttr("disabled");
          $("#insertForm")[0].reset();
          $(".preview_img").attr("src", "images/default_profile.jpg");
          $("#successToast").toast("show");
          $("#successMsg").html(response.message);
          fetchData();
        } else if(response.statusCode == 500) {
          $("#addUserModal").modal("hide");
          $("#insertBtn").removeAttr("disabled");
          $("#insertForm")[0].reset();
          $(".preview_img").attr("src", "images/default_profile.jpg");
          $("#errorToast").toast("show");
          $("#errorMsg").html(response.message);
        } else if(response.statusCode == 400) {
          $("#insertBtn").removeAttr("disabled");
          $("#errorToast").toast("show");
          $("#errorMsg").html(response.message);
        }
      }
    });
  });

  // Function to edit data using a modal
  $("#myTable").on("click", ".editBtn", function() {
    var id = $(this).val();
    $.ajax({
      url: "server.php?action=fetchSingle",
      type: "POST",
      dataType: "json",
      data: {
        id: id
      },
      success: function(response) {
        var data = response.data;
        $("#editForm #editId").val(data.id);
        $("#editForm input[name='description']").val(data.description);
        
        // Display the old image
        $("#editForm .preview_img").attr("src", "uploads/" + data.image);
        
        // Store the old image name in a hidden field
        $("#editForm #image_old").val(data.image);
        
        // Show the edit user modal
        $("#editUserModal").modal("show");
      }
    });
  });

  // Function to update data in the database using a modal
  $("#editForm").on("submit", function(e) {
    $("#editBtn").attr("disabled", "disabled");
    e.preventDefault();
    $.ajax({
      url: "server.php?action=updateData",
      type: "POST",
      data: new FormData(this),
      contentType: false,
      cache: false,
      processData: false,
      success: function(response) {
        var response = JSON.parse(response);
        if (response.statusCode == 200) {
          $("#editUserModal").modal("hide");
          $("#editBtn").removeAttr("disabled");
          $("#editForm")[0].reset();
          $(".preview_img").attr("src", "images/default_profile.jpg");
          $("#successToast").toast("show");
          $("#successMsg").html(response.message);
          fetchData();
        } else if(response.statusCode == 500) {
          $("#editUserModal").modal("hide");
          $("#editBtn").removeAttr("disabled");
          $("#editForm")[0].reset();
          $(".preview_img").attr("src", "images/default_profile.jpg");
          $("#errorToast").toast("show");
          $("#errorMsg").html(response.message);
        } else if(response.statusCode == 400) {
          $("#editBtn").removeAttr("disabled");
          $("#errorToast").toast("show");
          $("#errorMsg").html(response.message);
        }
      }
    });
  });

  // Function to delete data using a modal
  $("#myTable").on("click", ".deleteBtn", function() {
    if(confirm("Are you sure you want to delete this image data?")) {
      var id = $(this).val();
      var delete_image = $(this).closest("td").find(".delete_image").val();
      $.ajax({
        url: "server.php?action=deleteData",
        type: "POST",
        dataType: "json",
        data: {
          id,
          delete_image
        },
        success: function(response) {
          if(response.statusCode == 200) {
            fetchData();
            $("#successToast").toast("show");
            $("#successMsg").html(response.message);
          } else if(response.statusCode == 500) {
            $("#errorToast").toast("show");
            $("#errorMsg").html(response.message);
          }
        }
      });
    }
  });
});
