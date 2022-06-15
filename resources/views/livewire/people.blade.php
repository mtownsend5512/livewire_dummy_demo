<div class="p-10">
    <div class="mb-6 pb-6 border-b">
        <input class="border p-2 rounded" wire:model="filter" type="filter" placeholder="Filter by name">
    </div>

    <table>
        <tr>
            <th class="p-1 text-left text-sm font-semibold text-gray-900">First Name</th>
            <th class="p-1 text-left text-sm font-semibold text-gray-900">Last Name</th>
            <th class="p-1 text-left text-sm font-semibold text-gray-900" colspan="2">Age</th>
        </tr>
        @foreach ($people as $index => $person)
        <tr>
            <form wire:submit.prevent="update({{ $person->id }}, {{ $index }}, Object.fromEntries(new FormData($event.target)))">
                <td class="p-1">
                    <input class="border rounded p-1 @error("{$index}_first_name") border-red-500 bg-red-50 @enderror" type="text" name="first_name" value="{{ $person->first_name }}">
                    @error("{$index}_first_name") <span class="text-red-500 font-bold text-xs block">{{ $message }}</span> @enderror
                </td>
                <td class="p-1">
                    <input class="border rounded p-1 @error("{$index}_last_name") border-red-500 bg-red-50 @enderror" type="text" name="last_name" value="{{ $person->last_name }}">
                    @error("{$index}_last_name") <span class="text-red-500 font-bold text-xs block">{{ $message }}</span> @enderror
                </td>
                <td class="p-1">
                    <input class="border rounded p-1 @error("{$index}_age") border-red-500 bg-red-50 @enderror" type="number" name="age" value="{{ $person->age }}" id="age">
                    @error("{$index}_age") <span class="text-red-500 font-bold text-xs block">{{ $message }}</span> @enderror
                </td>
                <td class="p-1">
                    <button class="rounded border bg-gray-100 hover:bg-gray-200 p-1 px-3" type="submit">Save</button>
                </td>
            </form>
        </tr>
        @endforeach
    </table>

    <form class="mt-6 pt-6 border-t" wire:submit.prevent="create">
        <h2 class="font-extrabold text-2xl mb-4">Create a new person</h2>
        <div class="max-w-lg">
            <div class="grid grid-cols py-2">
                <label class="font-medium" for="first_name">First Name</label>
                <input class="border p-2 rounded @error('firstName') border-red-500 bg-red-50 @enderror" type="text" wire:model="firstName">
                @error('firstName') <span class="text-red-500 font-bold text-xs block">{{ $message }}</span> @enderror
            </div>

            <div class="grid grid-cols py-2">
                <label class="font-medium" for="last_name">Last Name</label>
                <input class="border p-2 rounded @error('lastName') border-red-500 bg-red-50 @enderror" type="text" wire:model="lastName">
                @error('lastName') <span class="text-red-500 font-bold text-xs block">{{ $message }}</span> @enderror
            </div>

            <div class="grid grid-cols py-2">
                <label class="font-medium" for="age">Age</label>
                <input class="border p-2 rounded @error('age') border-red-500 bg-red-50 @enderror" type="text" wire:model="age">
                @error('age') <span class="text-red-500 font-bold text-xs block">{{ $message }}</span> @enderror
            </div>

            <div class="py-4">
                <button class="bg-blue-600 hover:bg-blue-400 text-white rounded p-2" type="submit">Create Person</button>
            </div>
        </div>
    </form>
</div>