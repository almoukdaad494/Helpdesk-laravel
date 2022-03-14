<x-app-layout>
    <x-slot name="header">
        <h2 font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Applicants') }}
        </h2>

    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">

                    <x-auth-session-status class="mb-4" :status="session('status')" />

                    @if( $applicants->isEmpty() )
                    Currently no applications...
                    @else
                    <table style="width:80%" >
                    <tr>
                    <td class="title">Name</td>
                    <td class="title" >E-mail</td>
                    <td class="title">Date</td>
                    <td class="title" >employee</td>
                    </tr>
                    
                    @foreach($applicants as $applicant)
                    <tr>
                    <td>{{ $applicant->user->name }}</td>
                    
                    <td>
                    <x-link :href="('mailto:' . $applicant->user->email)">
                    {{ $applicant->user->email }}
                    </x-link>
                    </td>

                    <td>{{ $applicant->created_at->toFormattedDateString() }}</td>
                    <td>


                    @can('employ', $applicant)
                    <form action= "{{ route('applicant.employ', ['applicant' => $applicant]) }} "
                    method="POST" class="inline-flex">
                    @csrf
                    @method('PUT')<button class="text-green-500">
                    <i class="far fa-smile"></i>
                    </button>
                    </form>
                    @endcan


                    @can('queue', $applicant)
                    <form action= "{{ route('applicant.queue', ['applicant' => $applicant]) }} "
                    method="POST" class="inline-flex">
                    @csrf
                    @method('PUT')
                    <button class="text-yellow-500">
                    <i class="far fa-meh-blank"></i>
                    </button>
                    </form>
                    @endcan


                    @can('reject', $applicant)
                    <form action= "{{ route('applicant.reject', ['applicant' => $applicant]) }} "
                    method="POST" class="inline-flex">
                    @csrf
                    @method('DELETE')<button class="text-red-500">
                    <i class="far fa-frown"></i>
                    </button>
                    </form>
                    @endcan
                    

                    </td>
                    </tr>

                    @endforeach
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