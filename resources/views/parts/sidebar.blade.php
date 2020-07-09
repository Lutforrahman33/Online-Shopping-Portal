     <!-- sidebar -->

         
            <div class="list-group">
                @foreach(App\Category::orderBy('name' , 'asc')->where('parent_id' , NULL)->get() as $parent)
                
                      <a href="#main-{{ $parent->id }}" class="list-group-item list-group-item-action" data-toggle="collapse">
                      	{{ $parent->name }}
                      </a>

                      <div class="collapse
                         @if(Route::is('pages.categories.show'))
                           @if(App\category::ParentOrNot($parent->id , $category->id))
                           active
                           @endif
                         @endif
                      " id="main-{{ $parent->id }}">

                         <div class="child-row ">
                        @foreach(App\Category::orderBy('name' , 'asc')->where('parent_id' , $parent->id)->get() as $child)
                            
                            <a href="{!! route('pages.categories.show' , $child->id) !!}" class="list-group-item list-group-item-action 
                             @if(Route::is('pages.categories.show'))
                               @if($child->id == $category->id)
                                active
                               @endif
                             @endif

                              ">{{ $child->name }}
                            </a>

                         @endforeach              

                           
                         </div>
                         

                      </div>
                @endforeach  

               
            </div> 
                       
                
         <!-- end sidebar-->

           
     


