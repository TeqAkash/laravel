<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
<div class="flex flex-col">
  <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
    <div class="py-4 inline-block w-full sm:px-6 lg:px-8">
      <div class="overflow-hidden">
        <table class="w-full text-center">
            <thead class="border-b bg-gray-800">
                  <tr>
                    <th scope="col" class="text-sm font-medium text-white px-6 py-4">
                    id
                    </th>
                    <th scope="col" class="text-sm font-medium text-white px-6 py-4">
                    Name
                    </th>
                    <th scope="col" class="text-sm font-medium text-white px-6 py-4">
                    Email
                    </th>
                    <th scope="col" class="text-sm font-medium text-white px-6 py-4">
                    Action
                    </th>
                  </tr>
            </thead class="border-b">
          <tbody>
            <tr class="bg-white border-b">
              <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
              {{$data->id}}
              </td>
              <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
              {{$data->name}}
              </td>
              <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
              {{$data->email}}
              </td>
              <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
              @csrf
              @method('DELETE')
              <button type="submit" class="px-4 py-1 text-sm text-dark bg-red-400 rounded">Delete</button>
              </td>
            </tr class="bg-white border-b">
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>



           
           




                </div>
        </div>
    </div>
    </div>
</x-app-layout>
