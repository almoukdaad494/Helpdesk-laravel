<form action= "{{ route( $route , ['applicant' => $applicant]) }} "
method='POST' class="inline-flex">
@csrf
@method($method)

<button class= '$buttoncolor' >
<i class = '$icon'  ></i>
</button>
</form>
