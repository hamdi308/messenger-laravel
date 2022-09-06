<div>
	<div class="container">
    <div class="row justify-content-center">
      
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        Users
                    </div>
                    <div class="card-body chatbox p-0">
                        <ul class="list-group list-group-flush">
                          @foreach($users as $user)

                          @if($user->id !== auth()->id())
                          @php
                              $not_seen= App\Models\Message::where('user_id',$user->id)->where('receiver_id',auth()->id())->where('is_seen',false)->get() ?? null

                          @endphp
                                <a wire:click="getUser({{$user->id}})"  class="text-dark link">
                                    <li class="list-group-item">
                                        <img class="img-fluid avatar rounded" src="images/me.jpg">
                                        @if($user->is_online==true)

                                         <i class="fa fa-circle text-success online-icon">
                                            @endif
                                             
                                         </i> {{$user->name}}
                                       @if(filled($not_seen))
                                            <div class="badge badge-danger rounded"> {{ $not_seen->count()}} </div>
                                            @endif
                                    </li>
                                </a>
                                @endif
                          @endforeach
                        </ul>
                    </div>
                </div>
            </div>
  
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                     @if(isset($sender)) {{$sender->name}}   @endif 
                </div>
                <div class="card-body message-box" wire:poll="mountdata">
                   @if(filled($allmessages))
                     @foreach($allmessages as $mgs)
                            <div class="single-message @if($mgs->user_id == auth()->id()) sent @else received @endif">
                                <p class="font-weight-bolder my-0">@if($mgs->user_id == auth()->id()) {{$moi}} @else {{$sender->name}} @endif
                                
                                
                                
                                
                                
                                
                                
                                 </p>
                              {{ $mgs->message }}
                                <br><small class="text-muted w-100">envoyé <em>{{$mgs->created_at}}</em></small>
                            </div>

                            @endforeach
                            @endif
                        
                </div>
                 
                <div class="card-footer">
                    <form wire:submit.prevent="SendMessage">
                        <div class="row">
                            <div class="col-md-8">
                                <input wire:model="message" class="form-control input shadow-none w-100 d-inline-block" placeholder="Type a message" required>
                            </div>

                            <div class="col-md-4">
                                <button type="submit" class="btn btn-primary d-inline-block w-100">Envoyer</button>
                            </div>
                        </div>
                    </form>
                </div>
             
            </div>
        </div>
    </div>
</div>
</div>
