@extends('../layouts/app')



@section('content')

<section class="bg-gray-50 dark:bg-gray-900">

  <div class="h-screen flex flex-col items-center justify-center px-6 py-8 mx-auto lg:py-0">

      <h1 class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl dark:text-white mb-6">

        Admin Login

      </h1>

      <div class="login-form w-full bg-white rounded-lg shadow dark:border md:mt-0 sm:max-w-md xl:p-0 dark:bg-gray-800 dark:border-gray-700">

          <div class="p-6 space-y-4 md:space-y-6 sm:p-8">

              <form class="space-y-4 md:space-y-6" action="{{url('/admin/login')}}" method="POST">

                  @csrf

                  <div>

                      <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Email Address</label>

                      <input type="email" name="email" id="email" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="name@company.com" required="">

                      @if($errors->has('email'))

                          <div class="error">{{ $errors->first('email') }}</div>

                      @endif

                  </div>

                  <div>

                      <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Password</label>

                      <input type="password" name="password" id="password" placeholder="••••••••" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required="">

                      @if($errors->has('password'))

                          <div class="error">{{ $errors->first('password') }}</div>

                      @endif

                  </div>

                  <button type="submit" class="w-full text-white bg-primary-600 hover:bg-primary-700 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">Sign in</button>

              </form>

          </div>

      </div>

  </div>

</section>

@endsection