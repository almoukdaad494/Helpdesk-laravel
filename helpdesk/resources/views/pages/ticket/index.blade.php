<x-app-layout>
    <x-slot name="header">
        <h2 font-semibold text-xl text-gray-800 leading-tight">
            {{ __( $status ) }}
        </h2>

    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">

                    <x-auth-session-status class="mb-4" :status="session('status')" />

                    @if( $tickets->isEmpty() )
                    No Tickets in this list
                    @else

                    <table style="width:80%" >
                    <tr>
                    
                    <td class="title"> date </td>
                    @if(Auth::user()->role->id != App\Models\Role::CUSTOMER )<td class="title"> customer </td>@endif
                    <td class="title"> subject  </td>
                    <td class="title"> category </td>
                    <td class="title"> status </td>
                    @can('read_employee_names',  App\Models\Ticket::class )
                    <td class="title"> employees </td>
                    @endcan


                    </tr>
                    @foreach($tickets as $ticket)
                    <tr>

                    <td>{{ date_format( $ticket->created_at, 'd-m-Y') }}</td>

                    @if(Auth::user()->role->id != App\Models\Role::CUSTOMER )<td>{{ $ticket->creating_user->name }}</td>@endif

                    <td>
                    <x-link href="{{ route('ticket.show', $ticket->id) }}">
                    {{ $ticket->subject }}
                    </x-link>
                    </td>
                    
                    <td>{{ $ticket->category->name }}</td>
                    <td>{{ $ticket->status() }}</td>
                    
                    @can('read_employee_names', App\Models\Ticket::class )
                    <td>{{ $ticket->proccessing_users->pluck('name')->join(', ' , ' and ') }}</td>
                    @endcan
                    
                    </tr>

                    @endforeach

                    </table>
                    
                    @endif
                    
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