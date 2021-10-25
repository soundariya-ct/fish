@if($child_category->getChildrenCategory)
    @foreach($child_category->getChildrenCategory as $key => $childcat)
        <option value="{{ $childcat->id }}" {{ (@$childcat->id == @$questionCategory)?'selected':'' }}>|---{{ ucFirst($childcat->name) }}</option>
        @include('admin.course_category.child',['child_category' => $childcat])
    @endforeach
@endif
