@extends('layouts.apps')

@section('title')
Bravo Bangunan
@endsection

@section('content')
	<table>
		@for ($i=0; $i < count($room); $i++) 
		<tr>
			@for ($j=0; $j < count($room[$i]); $j++) 
				<td>{{ $room[$i][$j] }}</td>
	    	@endfor 
	    </tr>            
	    @endfor        
    </table>
        
@endsection