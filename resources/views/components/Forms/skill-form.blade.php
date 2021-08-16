<form action="" data-id="{{ isset($skill) ? $skill->id : '' }}">
    <div class="form-group">
        <label for="skillName">Skill Name</label>
        <input type="text" class="form-control" id="skillName" name="skillName"
               value="{{ isset($skill) ? $skill->name : '' }} ">
    </div>
    <div class="form-group">
        <label for="SkillDescription">Skill SkillDescription</label>
        <textarea name="SkillDescription" id="SkillDescription"> {{ isset($skill) ? $skill->description : '' }} </textarea>
    </div>
    <div class="button_dispay">

        @if(isset($skill))
            <button onclick="update_skill()">Update</button>
        @else
            <button onclick="add_new_skill()">Add</button>
        @endif
        <button onclick="delete_skill()">Delete</button>
    </div>
</form>
