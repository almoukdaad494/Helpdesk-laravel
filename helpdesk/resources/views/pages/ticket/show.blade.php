<x-app-layout>
    <x-slot name="header">
        <h2 font-semibold text-xl text-gray-800 leading-tight">
             Ticket
        </h2>

    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">

                    <x-auth-session-status class="mb-4" :status="session('status')" />


                    <table style="width:80%" >
                    <tr><td class="title"> subject  </td></tr>

                    <tr>
                    <td>
                    {{ $ticket->subject }}
                    </td>
            
                    
                    </tr>


                    </table>                    
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<style>

.title {
    color: #1a202c;
    font-size: 1.25rem;
    line-height: 1.25;
    }

</style>