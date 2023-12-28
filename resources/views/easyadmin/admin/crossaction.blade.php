<x-easyadmin::partials.adminpanel>
    <div>
        <h3 class="text-xl font-bold pb-3 print:hidden"><span>{{$title}}</span></h3>
        <div x-data="{
                fixedHeader: false,
                postUrl: '',
                yItemName: '',
                updateYitems(rid, pid, granted) {
                    let g = granted ? 1 : 0;
                    params = {
                        x_id: rid,
                        y_id: pid,
                        granted: g
                    };
                    axios.post(
                        this.postUrl,
                        params
                    ).then(
                        (r) => {
                            console.log(r);
                            if (!r.data.success) {
                                $dispatch('shownotice', {message: 'Someething went wrong. Couldn\'t update the ' + this.yItemName, mode: 'error', redirectUrl: null, redirectRoute: null});
                            } else {
                                $dispatch('showtoast', {message: this.yItemName + ' updated!', mode: 'success',});
                            }
                        }
                    ).catch();
                }
            }"
            x-init="
                postUrl = '{{route($actionRoute)}}';
                yItemName = '{{$yItemName}}';
            "
            class="rounded-md border border-base-200 inline-block max-w-full overflow-x-scroll max-h-4/5"
            >
            <table id="{{Str::plural($xItemName)}}-table" class="table w-auto">
                <thead class="font-bold bg-base-200 rounded-t-md sticky top-0">
                    <tr>
                        <th class="px-4 py-2 text-left">{{$yItemName}}</th>
                        @foreach ($xItems as $x)
                            <th class="text-center py-2">
                                {{$x->$xDisplayKey}}
                            </th>
                        @endforeach
                    </tr>
                </thead>
                <tbody>
                    @foreach ($yItems as $y)
                    <tr>
                        <td class="py-2 px-4">
                            {{$y->$yDisplayKey}}
                        </td>
                        @foreach ($xItems as $x)
                            <td x-data="{
                                    @if(in_array($y->id, $x->permissions()->pluck('id')->toArray()))
                                    check: true,
                                    @else
                                    check: false
                                    @endif
                                }
                                "
                                class="text-center"
                                >
                                <input x-model="check" type="checkbox" class="checkbox checkbox-xs" :class="!check || 'checkbox-primary'" :checked="check" @change="updateYitems({{$x->id}}, {{$y->id}}, check);">
                            </td>
                        @endforeach
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-easyadmin::partials.adminpanel>
