<x-partbook-layout>
            <div class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="card ">
                                <div class="card-header ">
                                    <h4 class="card-title">{{$askPrice->user->company}} </h4>
                                    <p class="card-category">
                                        {{$askPrice->user->company_address}} <br />
                                        "{{$askPrice->user->name}}" &lt;{{$askPrice->user->email}}&gt;
                                    </p>
                                </div>
                                <div class="card-body ">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th scope="col">No</th>
                                            <th scope="col">Part Name</th>
                                            <th scope="col">Machine</th>
                                            <th scope="col">Qty</th>
                                            <!--<th scope="col">Quality</th>-->
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($askPrice->askPriceLines as $askpriceline)
                                        <tr>
                                            <th scope="row">{{$loop->iteration}}</th>
                                            <td>{{$askpriceline->partno}} {{$askpriceline->partname}}</td>
                                            <td>{{$askpriceline->machine}} </td>
                                            <td>{{$askpriceline->qty}}</td>
                                            <!--<td>
                                                @switch($askpriceline->quality)
                                                    @case('0')
                                                        Original 
                                                        @break

                                                    @case('1')
                                                        Kawe
                                                        @break

                                                    @case('2')
                                                        Both
                                                        @break

                                                @endswitch
                                                
                                            </td>-->
                                            
                                        </tr>
                                        @endforeach  
                                    </tbody> 
                                </table>
                                </div>
                                <div class="card-footer ">
                                    <a href='{{route("askprices.excel")}}' class='btn btn-primary'>Save Excel</a>
                                    <a href='{{route("askprices.main")}}' class='btn btn-danger'>Home</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </x-partbook-layout>