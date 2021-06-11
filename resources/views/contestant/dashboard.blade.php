@extends('layouts.contestant')
<!--ACTION SECTION -->
@section('actions')
<div class="col-md-2 offset-1">
    <a href="#" class="btn btn-warning btn-block shadow" data-toggle="modal" data-target="#joinHackathonModal">
        <i class="fas fa-plus"></i> Join Hackathon
    </a>
</div>
<div class="col-md-4">
    <a href="#" class="btn btn-success btn-block shadow" data-toggle="modal" data-target="#createTeamModal">
        <i class="fas fa-plus"></i> Create Team
    </a>
</div>
<div class="col-md-4 ">
    <form method="GET" action="">
        <div class="input-group">
            <input type="text" name="search" id="search" class="form-control shadow-sm" placeholder="Search">
            <span class="input-group-btn">
                <button type="submit" class="btn btn-primary"><i class="fas fa-search"></i></button>
            </span>
        </div>
    </form>
</div>
@endsection

@section('custom-modal')
    <!-- JOIN HACKATHON MODAL -->
    <div class="modal " id="joinHackathonModal">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header bg-warning text-white">
                    <h5 class="modal-title">Join class</h5>
                    <button class="close" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                </div>
                <form method="POST" action="">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="class_code" class="mb-2">Enter hackathon code to join</label>
                            <input type="text" class="form-control" id="class_code" name="code">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-warning" id="join" type="submit">Join</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- ./JOIN CLASS MODAL -->

    <!-- EXIT HACKATHON MODAL -->
    <div class="modal fade" id="exitClassModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title">Attention</h5>
                    <button class="close" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Do you really want to exit this class? This process cannot be undone.</p>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-dark" data-dismiss="modal">Back</button>
                    <form id="exit_class_form" method="POST" action="">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger" type="submit">Exit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- EXIT HACKATHON MODAL END -->

    <!-- CREATE TEAM MODAL -->
    <div class="modal " id="createTeamModal">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header bg-success text-white">
                    <h5 class="modal-title">Create Team</h5>
                    <button class="close" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                </div>
                <form method="POST" action="{{route('team.store')}}">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="team_name" class="mb-2">Team name</label>
                            <input type="text" class="form-control" id="team_name" name="name">
                            
                            <label for="num_members" class="mb-2">Number of members</label>
                            <input type="number" class="form-control mb-2" id="members" min="1" value="1" name="num_members">

                            <div class="team_member mb-2">
                                <label for="team_member_1" class="mb-2">Team Leader</label>
                                <input type="email" class="form-control" id="team_member_1" name="member1" placeholder={{Auth::guard(get_guard())->user()->email}} value={{Auth::guard(get_guard())->user()->email}} readonly>
                            </div>


                            {{-- 
                            <div class="team_member mb_1">
                                <label for="team_member_1" class="mb-2">Team member 1</label>
                                <input type="text" class="form-control" id="team_member_1" name="member1">
                            </div>
                            --}}
                            
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-success" id="join" type="submit">Create</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- CREATE HACKATHON MODAL END -->
@endsection

@section('custom-js')
<script type="text/javascript">
        function createNewInput(n){
            const div = document.createElement('div'); //team_member
            div.setAttribute('class','team_member mb-2');
            //child.classList.add(' ');
            const label = document.createElement('label');
            label.setAttribute('for',`team_member_${n}`);
            label.setAttribute('class','mb-2');
            label.textContent=`Team Member ${n}`;

            const input = document.createElement('input');
            input.setAttribute('type','email');
            input.setAttribute('class','form-control');
            input.setAttribute('id',`team_member_${n}`);
            input.setAttribute('name',`member${n}`);
            input.setAttribute('placeholder',`Enter email adress`);

            div.appendChild(label);
            div.appendChild(input);
            form.appendChild(div);
        }
        function deleteLastInput(){
            const form = document.querySelector('#createTeamModal .form-group');
            form.removeChild(form.lastChild);
        }
        const form = document.querySelector('#createTeamModal .form-group');
        const numberOfMembers = document.querySelector('#members');
        let old = numberOfMembers.value;
        numberOfMembers.addEventListener('change', ()=>{
            let n = numberOfMembers.value;
            if(n>old) createNewInput(n);
            else deleteLastInput();
            old = n;
        });

</script>
@endsection
