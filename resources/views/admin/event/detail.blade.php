@extends('../layouts/app')

@section('content')
<section class="bg-gray-50 dark:bg-gray-900">
  <div class="h-screen flex flex-col px-6 py-8">
      <h1 class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl dark:text-white mb-6 flex">
        {{$event->name}} {{$event->date}}
      
      <button type="button" id="eventlist" class="ml-auto text-white bg-primary-600 hover:bg-primary-700 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800"
                                                >Event's List</button></h1>
      <div class="w-full bg-white rounded-lg shadow dark:border xl:p-0 dark:bg-gray-800 dark:border-gray-700">
          <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
                <div>
                    <div class="flex items-center mb-2">
                        <label for="event date" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Guest list</label>
                        <button type="button" class="ml-auto text-white bg-primary-600 hover:bg-primary-700 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800"
                          data-modal-target="add-guest-modal" data-modal-toggle="add-guest-modal"
                        >Add guest</button>
                        <button type="button" class="ml-2 text-white bg-primary-600 hover:bg-primary-700 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800"
                          data-modal-target="del-all-modal" data-modal-toggle="del-all-modal"
                        >Delete all</button>
                    </div>
                    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    <th scope="col" class="px-6 py-3 bg-yellow-100">
                                        First Name
                                    </th>
                                    <th scope="col" class="px-6 py-3 bg-yellow-100">
                                        Last Name
                                    </th>
                                    <th scope="col" class="px-6 py-3 bg-yellow-100">
                                        Gender
                                    </th>
                                    <th scope="col" class="px-6 py-3 bg-yellow-100">
                                        Email
                                    </th>
                                    <th scope="col" class="px-6 py-3 bg-yellow-100">
                                        Phone
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        <span class="sr-only">Edit</span>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($event->guests as $guest)
                                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        {{$guest->first_name}}
                                    </th>
                                    <td class="px-6 py-4">
                                        {{$guest->last_name}}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{$guest->gender}}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{$guest->email}}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{$guest->phone}}
                                    </td>
                                    <td class="px-6 py-4 flex justify-end">
                                        <a href="#" data-event_id="{{$event->id}}" data-guest_id="{{$guest->id}}" class="btn-tb-action edit-guest font-medium"
                                          data-event_id="{{$event->id}}" data-guest_id="{{$guest->id}}"
                                          data-modal-target="edit-guest-modal" data-modal-toggle="edit-guest-modal"
                                        >
                                          <i class="fa fa-edit"></i>
                                        </a>
                                        <a href="#" class="btn-tb-action del-guest font-medium"
                                          data-event_id="{{$event->id}}" data-guest_id="{{$guest->id}}"
                                          data-modal-target="del-guest-modal" data-modal-toggle="del-guest-modal"
                                        >
                                          <i class="fa fa-trash"></i>
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div>
                    <div class="w-full flex">
                      <label for="event date" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Match list</label>
                      <a class="btn-send-all ml-auto" data-event_id="{{$event->id}}">
                        <i class="fa fa-envelope-o"></i>
                      </a>
                    </div>
                    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    <th colspan="2" scope="col" class="px-6 py-3 text-center bg-green-300">
                                        Male
                                    </th>
                                    <th colspan="2" scope="col" class="px-6 py-3 text-center bg-blue-400">
                                        Female
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        <span class="sr-only">Edit</span>
                                    </th>
                                </tr>
                                <tr>
                                    <th scope="col" class="px-6 py-3 bg-yellow-100">
                                        First Name
                                    </th>
                                    <th scope="col" class="px-6 py-3 bg-yellow-100">
                                        Last Name
                                    </th>
                                    <th scope="col" class="px-6 py-3 bg-yellow-100">
                                        First Name
                                    </th>
                                    <th scope="col" class="px-6 py-3 bg-yellow-100">
                                        Last Name
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        <span class="sr-only">Edit</span>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($couples as $couple)
                                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                            {{$couple->male->first_name}}
                                        </th>
                                        <td class="px-6 py-4">
                                            {{$couple->male->last_name}}
                                        </td>
                                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                            {{$couple->female->first_name}}
                                        </th>
                                        <td class="px-6 py-4">
                                            {{$couple->female->last_name}}
                                        </td>
                                        <td class="px-6 py-4 flex justify-end">
                                          <a href="#" class="btn-tb-action del-couple font-medium"
                                            data-event_id="{{$event->id}}" data-couple_id="{{$couple->id}}"
                                            data-modal-target="del-couple-modal" data-modal-toggle="del-couple-modal"
                                          >
                                            <i class="fa fa-trash"></i>
                                          </a>
                                          <a href="#" class="btn-tb-action send-match font-medium"
                                            data-event_id="{{$event->id}}" data-couple_id="{{$couple->id}}"
                                          >
                                            <i class="fa fa-paper-plane-o"></i>
                                          </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- <button type="button" class="w-full text-white bg-primary-600 hover:bg-primary-700 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">Save</button> -->
          </div>
      </div>
      <!-- Modals -->
      <!-- add guest -->
      <div id="add-guest-modal" tabindex="-1" aria-hidden="true" class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] md:h-full">
          <div class="relative w-full h-full max-w-md md:h-auto">
              <!-- Modal content -->
              <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                  <button type="button" class="btn-transparent absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-800 dark:hover:text-white" data-modal-hide="add-guest-modal">
                      <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                      <span class="sr-only">Close modal</span>
                  </button>
                  <div class="px-6 py-6 lg:px-8">
                      <h3 class="mb-4 text-xl font-medium text-gray-900 dark:text-white">Add Guest</h3>
                      <form class="space-y-6" action="#">
                          <input type="text" name="eid" id="eid" value="{{$event->id}}" class="hidden bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" required>
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

                          <button type="button" class="btn-save w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Save</button>
                      </form>
                  </div>
              </div>
          </div>
      </div>
      <!-- delete all guest -->
      <div id="del-all-modal" tabindex="-1" class="confirm-modal fixed top-0 left-0 right-0 z-50 hidden p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] md:h-full">
          <div class="relative w-full h-full max-w-md md:h-auto">
              <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                  <button type="button" class="btn-transparent absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-800 dark:hover:text-white" data-modal-hide="del-all-modal">
                      <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                      <span class="sr-only">Close modal</span>
                  </button>
                  <div class="p-6 text-center">
                      <svg aria-hidden="true" class="mx-auto mb-4 text-gray-400 w-14 h-14 dark:text-gray-200" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                      <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">Are you sure you want to delete all guest list?</h3>
                      <button data-id="{{$event->id}}" data-modal-hide="del-all-modal" type="button" class="btn-red text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center mr-2">
                          Yes, I'm sure
                      </button>
                      <button data-modal-hide="del-all-modal" type="button" class="btn-transparent text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">No, cancel</button>
                  </div>
              </div>
          </div>
      </div>
      <!-- edit guest -->
      <div id="edit-guest-modal" tabindex="-1" aria-hidden="true" class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] md:h-full">
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
                          <input type="text" name="eid" id="eid" class="hidden bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" placeholder="First Name" required>
                          <input type="text" name="gid" id="gid" class="hidden bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" placeholder="First Name" required>
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

                          <button type="button" class="btn-save w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Save</button>
                      </form>
                  </div>
              </div>
          </div>
      </div>
      <!-- delete guest -->
      <div id="del-guest-modal" tabindex="-1" class="confirm-modal fixed top-0 left-0 right-0 z-50 hidden p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] md:h-full">
        <div class="relative w-full h-full max-w-md md:h-auto">
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                <button type="button" class="btn-transparent absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-800 dark:hover:text-white" data-modal-hide="del-guest-modal">
                    <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                    <span class="sr-only">Close modal</span>
                </button>
                <div class="p-6 text-center">
                    <svg aria-hidden="true" class="mx-auto mb-4 text-gray-400 w-14 h-14 dark:text-gray-200" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">Are you sure you want to delete this guest?</h3>
                    <button data-event_id="" data-guest_id=""
                      data-modal-hide="del-guest-modal" type="button" class="btn-red text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center mr-2">
                        Yes, I'm sure
                    </button>
                    <button data-modal-hide="del-guest-modal" type="button" class="btn-transparent text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">No, cancel</button>
                </div>
            </div>
        </div>
      </div>
      <!-- delete couple -->
      @if(count($couples) > 0)
      <div id="del-couple-modal" tabindex="-1" class="confirm-modal fixed top-0 left-0 right-0 z-50 hidden p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] md:h-full">
        <div class="relative w-full h-full max-w-md md:h-auto">
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                <button type="button" class="btn-transparent absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-800 dark:hover:text-white" data-modal-hide="del-couple-modal">
                    <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                    <span class="sr-only">Close modal</span>
                </button>
                <div class="p-6 text-center">
                    <svg aria-hidden="true" class="mx-auto mb-4 text-gray-400 w-14 h-14 dark:text-gray-200" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">Are you sure you want to delete this match?</h3>
                    <button data-event_id="" data-guest_id=""
                      data-modal-hide="del-couple-modal" type="button" class="btn-red text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center mr-2">
                        Yes, I'm sure
                    </button>
                    <button data-modal-hide="del-couple-modal" type="button" class="btn-transparent text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">No, cancel</button>
                </div>
            </div>
        </div>
      </div>
      @endif
  </div>
</section>
<script>
  var base_url = "{{url('/')}}";
  $(document).on('click', '#add-guest-modal .btn-save', function() {
    $.ajax({
          url: `${base_url}/admin/event/${$('#add-guest-modal input[name=eid]').val()}/guest/create`,
          type: 'POST',
          data: {
            _token: '{{ csrf_token() }}',
            event_id: $('#add-guest-modal input[name=eid]').val(),
            first_name: $('#add-guest-modal input[name=first_name]').val(),
            last_name: $('#add-guest-modal input[name=last_name]').val(),
            email: $('#add-guest-modal input[name=email]').val(),
            phone: $('#add-guest-modal input[name=phone]').val(),
            gender: $('#add-guest-modal #male').prop('checked') ? 'Male' : 'Female',
          },
          success:function(res){
            toastr.success('Successfully added.');
            setTimeout(() => {
              location.reload();
            }, 1000);
          },
          error: function (err){
            toastr.error('Error');
          },
      });
  });
</script>
<script>
  $(document).on('click', '#del-all-modal .btn-red', function() {
    $.ajax({
          url: `${base_url}/admin/event/${$(this).data('id')}`,
          type: 'DELETE',
          data: {
            _token: '{{ csrf_token() }}',
          },
          success:function(res){
            toastr.success('Successfully removed.');
            setTimeout(() => {
              location.reload();
            }, 1000);
          },
          error: function (err){
            toastr.error('Error');
          },
      });
  })
</script>
<script>
  $(document).on('click', '.edit-guest', function() {
    $.ajax({
          url: `${base_url}/admin/event/${$(this).data('event_id')}/guest/${$(this).data('guest_id')}`,
          type: 'GET',
          data: {
            _token: '{{ csrf_token() }}',
          },
          success:function(res){
            if(res.success) {
              initGuestEditForm(res.data)
            }
          },
          error: function (err){
            toastr.error('Error');
          },
      });
  });

  function initGuestEditForm(data) {
    $('#edit-guest-modal input[name=eid]').val(data.event_id);
    $('#edit-guest-modal input[name=gid]').val(data.id);
    $('#edit-guest-modal input[name=first_name]').val(data.first_name);
    $('#edit-guest-modal input[name=last_name]').val(data.last_name);
    $('#edit-guest-modal input[name=email]').val(data.email);
    $('#edit-guest-modal input[name=phone]').val(data.phone);
    if(data.gender.toLowerCase() === 'male') {
      $('#edit-guest-modal #male').prop("checked", true);
    } else {
      $('#edit-guest-modal #female').prop("checked", true);
    }
    $('#edit-guest-modal input[name=gender]').val(data.gender);
  }

  $(document).on('click', '#edit-guest-modal .btn-save', function() {
    $.ajax({
          url: `${base_url}/admin/event/${$('#edit-guest-modal input[name=eid]').val()}/guest/${$('#edit-guest-modal input[name=gid]').val()}`,
          type: 'PUT',
          data: {
            _token: '{{ csrf_token() }}',
            event_id: $('#edit-guest-modal input[name=eid]').val(),
            guest_id: $('#edit-guest-modal input[name=gid]').val(),
            first_name: $('#edit-guest-modal input[name=first_name]').val(),
            last_name: $('#edit-guest-modal input[name=last_name]').val(),
            email: $('#edit-guest-modal input[name=email]').val(),
            phone: $('#edit-guest-modal input[name=phone]').val(),
            gender: $('#edit-guest-modal #male').prop('checked') ? 'Male' : 'Female',
          },
          success:function(res){
            toastr.success('Successfully updated.');
            setTimeout(() => {
              location.reload();
            }, 1000);
          },
          error: function (err){
            toastr.error('Error');
          },
      });
  });
</script>
<script>
  $(document).on('click', '.del-guest', function() {
    $('#del-guest-modal .btn-red').data('event_id', $(this).data('event_id'));
    $('#del-guest-modal .btn-red').data('guest_id', $(this).data('guest_id'));
  });
  $(document).on('click', '#del-guest-modal .btn-red', function() {
    $.ajax({
          url: `${base_url}/admin/event/${$(this).data('event_id')}/guest/${$(this).data('guest_id')}`,
          type: 'DELETE',
          data: {
            _token: '{{ csrf_token() }}',
          },
          success:function(res){
            toastr.success('Successfully removed.');
            setTimeout(() => {
              location.reload();
            }, 1000);
          },
          error: function (err){
            toastr.error('Error');
          },
      });
  });
</script>
<script>
  $(document).on('click', '.del-couple', function() {
    $('#del-couple-modal .btn-red').data('event_id', $(this).data('event_id'));
    $('#del-couple-modal .btn-red').data('couple_id', $(this).data('couple_id'));
  });
  $(document).on('click', '#del-couple-modal .btn-red', function() {
    $.ajax({
          url: `${base_url}/admin/event/${$(this).data('event_id')}/couple/${$(this).data('couple_id')}`,
          type: 'DELETE',
          data: {
            _token: '{{ csrf_token() }}',
          },
          success:function(res){
            toastr.success('Successfully removed.');
            setTimeout(() => {
              location.reload();
            }, 1000);
          },
          error: function (err){
            toastr.error('Error');
          },
      });
  });
</script>
<script>
  $(document).on('click', '.send-match', function() {
    $.ajax({
          url: `${base_url}/admin/event/match/send/${$(this).data('couple_id')}`,
          type: 'POST',
          data: {
            _token: '{{ csrf_token() }}',
          },
          success:function(res){

            toastr.success('Successfully sent email to matched couples!');
          },
          error: function (err){
            toastr.error('Error');
          },
      });
  });
  $(document).on('click', '.btn-send-all', function() {
    $.ajax({
          url: `${base_url}/admin/event/${$(this).data('event_id')}/match/send`,
          type: 'POST',
          data: {
            _token: '{{ csrf_token() }}',
          },
          success:function(res){
            toastr.success('Successfully sent email to matched couples!');
          },
          error: function (err){
            toastr.error('Error');
          },
      });
  });
  $(document).on('click','#eventlist', function(){
    location.href = `${base_url}/admin/event/`
  })
</script>
@endsection
