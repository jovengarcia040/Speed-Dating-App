@extends('../layouts/app')

@section('content')
<section class="bg-gray-50 dark:bg-gray-900">
  <div class="h-screen flex flex-col px-6 py-8">
      <div class="w-full flex p-4">
        <h1 class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl dark:text-white">
          Create new event
        </h1>
        <button type="button" class="btn-back ml-auto text-white bg-primary-600 hover:bg-primary-700 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">Back</button>
      </div>
      <hr />
      <div class="w-full bg-white rounded-lg shadow dark:border xl:p-0 dark:bg-gray-800 dark:border-gray-700">
          <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
              <form class="space-y-4 md:space-y-6" action="#">
                  <div>
                      <label for="event name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Event's name</label>
                      <input type="text" name="name" id="name" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Event's name" required="">
                  </div>
                  <div>
                      <label for="event date" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Event's date</label>
                      <input type="date" name="date" id="date" placeholder="Event's date" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required="">
                  </div>
                  <div>
                      <label for="guests" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Guest list</label>
                      <input type="file" name="upload" id="upload" placeholder="Upload guest list" class="hidden bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required="">
                      <button type="button" class="btn-upload ml-auto text-white bg-primary-600 hover:bg-primary-700 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800 mb-4">Upload guest list</button>
                      <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                          <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                              <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                  <tr>
                                      <th scope="col" class="px-6 py-3">
                                          First Name
                                      </th>
                                      <th scope="col" class="px-6 py-3">
                                          Last Name
                                      </th>
                                      <th scope="col" class="px-6 py-3">
                                          Gender
                                      </th>
                                      <th scope="col" class="px-6 py-3">
                                          Email
                                      </th>
                                      <th scope="col" class="px-6 py-3">
                                          Phone
                                      </th>
                                      <th scope="col" class="px-6 py-3">
                                          <span class="sr-only">Edit</span>
                                      </th>
                                  </tr>
                              </thead>
                              <tbody id="guest_list">

                              </tbody>
                          </table>
                      </div>
                  </div>
                </form>
                <hr />
                <div class="w-full flex">
                  <button type="button" class="btn-save ml-auto text-white bg-primary-600 hover:bg-primary-700 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">Save</button>
                </div>
          </div>
      </div>
  </div>
  <!-- edit guest -->
  <div id="edit-guest-modal" tabindex="-1" aria-hidden="true" class="bg-gray-900 bg-opacity-50 fixed top-0 left-0 right-0 z-50 hidden items-center justify-center w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] md:h-full">
      <div class="relative w-full h-full max-w-md md:h-auto">
          <!-- Modal content -->
          <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
              <button type="button" class="btn-transparent absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-800 dark:hover:text-white" data-modal-hide="edit-guest-modal">
                  <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                  <span class="sr-only">Close modal</span>
              </button>
              <div class="px-6 py-6 lg:px-8">
                  <h3 class="mb-4 text-xl font-medium text-gray-900 dark:text-white">Edit Guest's Info</h3>
                  <form class="space-y-6" action="#">
                      <input type="text" name="index" id="index" class="hidden bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" placeholder="First Name" required>
                      <div>
                          <label for="first name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">First Name</label>
                          <input type="text" name="first_name" id="first_name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" placeholder="First Name" required>
                      </div>
                      <div>
                          <label for="last name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Last Name</label>
                          <input type="text" name="last_name" id="last_name" placeholder="Last Name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" required>
                      </div>
                      <div class="flex justify-between">
                          <div class="flex items-start">
                            <div class="flex">
                              <div class="flex items-center h-5">
                                  <input id="male" name="gender" type="radio" value="Male" class="w-4 h-4 border border-gray-300 rounded bg-gray-50 focus:ring-3 focus:ring-blue-300 dark:bg-gray-600 dark:border-gray-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800" required>
                              </div>
                              <label for="male" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">Male</label>
                            </div>
                            <div class="flex">
                              <div class="flex items-center h-5 ml-4">
                                  <input id="female" name="gender" type="radio" value="Female" class="w-4 h-4 border border-gray-300 rounded bg-gray-50 focus:ring-3 focus:ring-blue-300 dark:bg-gray-600 dark:border-gray-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800" required>
                              </div>
                              <label for="female" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">FeMale</label>
                            </div>
                          </div>
                      </div>
                      <div>
                          <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Email</label>
                          <input type="email" name="email" id="email" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" placeholder="Email" required>
                      </div>
                      <div>
                          <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Phone</label>
                          <input type="phone" name="phone" id="phone" placeholder="phone" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" required>
                      </div>

                      <button type="button" class="btn-save-edit w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Save</button>
                  </form>
              </div>
          </div>
      </div>
  </div>
  <!-- delete guest -->
  <div id="del-guest-modal" tabindex="-1" class="confirm-modal bg-gray-900 bg-opacity-50 fixed top-0 left-0 right-0 z-50 hidden items-center justify-center p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] md:h-full">
    <div class="relative w-full h-full max-w-md md:h-auto">
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <button type="button" class="btn-transparent absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-800 dark:hover:text-white" data-modal-hide="del-guest-modal">
                <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                <span class="sr-only">Close modal</span>
            </button>
            <div class="p-6 text-center">
                <svg aria-hidden="true" class="mx-auto mb-4 text-gray-400 w-14 h-14 dark:text-gray-200" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">Are you sure you want to delete this guest?</h3>
                <button data-index=""
                  data-modal-hide="del-guest-modal" type="button" class="btn-red text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center mr-2">
                    Yes, I'm sure
                </button>
                <button data-modal-hide="del-guest-modal" type="button" class="btn-transparent text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">No, cancel</button>
            </div>
        </div>
    </div>
  </div>
</section>
<script>
  var base_url = "{{url('/')}}";
  $(document).on('click', '.btn-upload', function (e) {
    $('#upload').click();
  });
</script>
<script>
  var guest_list = [];
  var ExcelToJSON = function() {

    this.parseExcel = function(file) {
      var reader = new FileReader();

      reader.onload = function(e) {
        var data = e.target.result;
        var workbook = XLSX.read(data, {
          type: 'binary'
        });
        workbook.SheetNames.forEach(function(sheetName) {
          // Here is your object
          var guests = XLSX.utils.sheet_to_json(workbook.Sheets[sheetName],{ raw: false });
          if(guests.length > 0) {
            for (var i = 0; i < guests.length; i++) {
              guest_list.push({
                first_name: guests[i]['First Name'],
                last_name: guests[i]['Last Name'],
                gender: guests[i]['Gender'] === "m"? "Male" : "Female",
                email: guests[i]['Email'],
                phone: guests[i]['Phone'],
              });
            }
            renderGuestList();
          }
          $('#xlx_json').val(guests);
        })
      };

      reader.onerror = function(ex) {

      };

      reader.readAsBinaryString(file);
    };
  };

  function handleFileSelect(evt) {

    var files = evt.target.files; // FileList object
    var xl2json = new ExcelToJSON();
    xl2json.parseExcel(files[0]);
  }

  function renderGuestList() {

    //
    $('#guest_list').empty();
    for (var i = 0; i < guest_list.length; i++) {
      $('#guest_list').append(`<tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                  <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                      ${guest_list[i].first_name}
                                  </th>
                                  <td class="px-6 py-4">
                                      ${guest_list[i].last_name}
                                  </td>
                                  <td class="px-6 py-4">
                                      ${guest_list[i].gender}
                                  </td>
                                  <td class="px-6 py-4">
                                      ${guest_list[i].email}
                                  </td>
                                  <td class="px-6 py-4">
                                      ${guest_list[i].phone}
                                  </td>
                                  <td class="px-6 py-4 flex justify-end">
                                      <a data-index="${i}" class="btn-tb-action edit-guest font-medium"
                                        data-modal-target="edit-guest-modal" data-modal-toggle="edit-guest-modal"
                                      >
                                        <i class="fa fa-edit"></i>
                                      </a>
                                      <a data-index="${i}" class="btn-tb-action del-guest font-medium"
                                        data-modal-target="del-guest-modal" data-modal-toggle="del-guest-modal"
                                      >
                                        <i class="fa fa-trash"></i>
                                      </a>
                                  </td>
                              </tr>`);
    }
  }
</script>
<script>
  document.getElementById('upload').addEventListener('change', handleFileSelect, false);
  $(document).on('click', '.btn-save', function() {

    // if($('#name').val() && $('#date') && guest_list.length > 0) {
      $.ajax({
          url: `${base_url}/admin/event/create`,
          type: 'POST',
          data: {
            _token: '{{ csrf_token() }}',
            name: $('#name').val(),
            date: $('#date').val(),
            guest_list: guest_list,
          },
          success:function(res){
            if(res.success) {
              toastr.success(res.message);
              window.location.href = `${base_url}/admin/event`;
            } else {
              toastr.warning(res.message);
            }
          },
          error: function (err){
            if(err.responseJSON) {
              toastr.error(err.responseJSON.message);
            }
          },
      });
    // }
  });
</script>
<script>
  $(document).on('click', '.edit-guest', function(e) {

    var index = $(this).data('index');
    var guest = guest_list[index];
    $('#edit-guest-modal input[name="index"]').val(index);
    $('#edit-guest-modal input[name="first_name"]').val(guest.first_name);
    $('#edit-guest-modal input[name="last_name"]').val(guest.last_name);
    $('#edit-guest-modal input[name="email"]').val(guest.email);
    $('#edit-guest-modal input[name="phone"]').val(guest.phone);
    //
    $('#edit-guest-modal input[name="gener"]').val(guest.gender);
    $('#edit-guest-modal #male').prop('checked', false);
    $('#edit-guest-modal #female').prop('checked', false);
    if(guest.gender == "Male") {
      $('#edit-guest-modal #male').prop('checked', true);
    } else {
      $('#edit-guest-modal #female').prop('checked', true);
    }
    $('#edit-guest-modal').css('display', 'flex');
  });
  $(document).on('click', '#edit-guest-modal button', function(e) {
    $('#edit-guest-modal').css('display', 'none');
  });
  $(document).on('click', '#edit-guest-modal .btn-save-edit', function(e) {
    var index = $('#edit-guest-modal input[name="index"]').val();
    var guest_update = {
      first_name: $('#edit-guest-modal input[name="first_name"]').val(),
      last_name: $('#edit-guest-modal input[name="last_name"]').val(),
      gender: $('#edit-guest-modal #male').prop('checked') === true ? 'Male' : ($('#edit-guest-modal #female').prop('checked') === true ? 'Female' : ''),
      email: $('#edit-guest-modal input[name="email"]').val(),
      phone: $('#edit-guest-modal input[name="phone"]').val()
    }
    guest_list[index] = guest_update;
    renderGuestList();
    $('#edit-guest-modal').css('display', 'none');
  });
</script>
<script>
  $(document).on('click', '.del-guest', function(e) {
    var index = $(this).data('index');
    //
    $('#del-guest-modal .btn-red').data('index', index);
    $('#del-guest-modal').css('display', 'flex');
  });
  $(document).on('click', '#del-guest-modal button', function(e) {
    $('#del-guest-modal').css('display', 'none');
  });
  $(document).on('click', '#del-guest-modal .btn-red', function(e) {
    var index = $(this).data('index');
    $('#del-guest-modal').css('display', 'none');
    guest_list.splice(index, 1);
    renderGuestList();
  });
  $(document).on('click','.btn-back', function(){
    location.href = `${base_url}/admin/`
  })
</script>
@endsection
