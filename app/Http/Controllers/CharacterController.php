<?php

namespace App\Http\Controllers;

use App\Models\Character;
use Illuminate\Http\Request;

class CharacterController extends Controller
{
    public function index()
    {
        

        return view('characters.index');
    }

    public function indexTable(Request $request)
    {
        // yajra datatables
        if ($request->ajax()) {
            $user = $request->user();

            $characters = Character::select('characters.*')
                ->where('user_id', $user->id)
                ->with('user');
                
                

            return datatables()->of($characters)
                ->addColumn('actions', function ($character) use ($user) {
                    $actions = '';
                    
                    if ($user->hasPermission('show-characters')) {
                        $actions .= '<a href="' . route('characters.show', $character) . '" class="text-green-600 dark:text-green-400 hover:underline mr-3">View</a>';
                    }
                    
                    if ($user->hasPermission('edit-characters')) {
                        $actions .= '<a href="' . route('characters.edit', $character) . '" class="text-blue-600 dark:text-blue-400 hover:underline mr-3">Edit</a>';
                    }
                    
                    if ($user->hasPermission('delete-characters')) {
                        $actions .= '<form action="' . route('characters.destroy', $character) . '" method="POST" class="inline" onsubmit="return confirm(\'Are you sure?\')">
                            ' . csrf_field() . method_field('DELETE') . '
                            <button type="submit" class="text-red-600 dark:text-red-400 hover:underline">Delete</button>
                        </form>';
                    }
                    
                    return $actions ?: '-';
                })
                ->editColumn('created_at', function ($character) {
                    return $character->created_at->format('M d, Y');
                })
                ->rawColumns(['actions'])
                ->make(true);

            
                

            
        }
    }

    public function create()
    {
        $aiModels = config('helper.ai_models');

        return view('characters.create', compact('aiModels'));
    }

    public function store(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'character_name' => 'required|string|max:255',
            'character_avatar' => 'nullable|file|mimes:jpg,jpeg,png,gif|max:2048',
            'character_concept' => 'nullable|file|mimes:jpg,jpeg,png,gif|max:2048',
            'ai_model' => 'required|string|in:' . implode(',', array_keys(config('helper.ai_models'))),
            'system_prompt' => 'nullable|string',
            'is_proactive' => 'string|in:true,false,on,off,1,0',
            'proactive_intensity' => 'nullable|integer|min:1|max:10',
            'quiet_start' => 'nullable|date_format:H:i',
            'quiet_end' => 'nullable|date_format:H:i',
        ]);

        // Convert the 'is_proactive' field to a boolean value
        $request->merge([
            'is_proactive' => filter_var($request->input('is_proactive'), FILTER_VALIDATE_BOOLEAN),
        ]);

        $character = new Character($request->all());
        $character->user_id = $request->user()->id;


        //handle file input for character_avatar
        if ($request->hasFile('character_avatar')) {
            $originalExtension = $request->file('character_avatar')->getClientOriginalExtension();
            $newFileName = 'avatar_' . $character->id . '.' . $originalExtension;
            $avatarPath = $request->file('character_avatar')->storeAs('avatars', $newFileName, 'public');
            $character->character_avatar = $avatarPath;
        }

        //handle file input for character_concept
        if ($request->hasFile('character_concept')) {
            $originalExtension = $request->file('character_concept')->getClientOriginalExtension();
            $newFileName = 'concept_' . $character->id . '.' . $originalExtension;
            $conceptPath = $request->file('character_concept')->storeAs('concepts', $newFileName, 'public');
            $character->character_concept = $conceptPath;
        }


        $character->save();

        return redirect()->route('characters.index')->with('success', 'Character created successfully.');
    }

    public function show(Character $character)
    {
        return view('characters.show', compact('character'));
    }

    public function edit(Character $character)
    {
        $aiModels = config('helper.ai_models');

        return view('characters.edit', compact('character', 'aiModels'));
    }

    public function update(Request $request, Character $character)
    {
        $request->validate([
            'character_name' => 'required|string|max:255',
            'character_avatar' => 'nullable|file|mimes:jpg,jpeg,png,gif|max:2048',
            'character_concept' => 'nullable|file|mimes:jpg,jpeg,png,gif|max:2048',
            'ai_model' => 'required|string|in:' . implode(',', array_keys(config('helper.ai_models'))),
            'system_prompt' => 'nullable|string',
            'is_proactive' => 'string|in:true,false,on,off,1,0',
            'proactive_intensity' => 'nullable|integer|min:1|max:10',
            'quiet_start' => 'nullable|date_format:H:i',
            'quiet_end' => 'nullable|date_format:H:i',
        ]);

        // Convert the 'is_proactive' field to a boolean value
        $request->merge([
            'is_proactive' => filter_var($request->input('is_proactive'), FILTER_VALIDATE_BOOLEAN),
        ]);

        $character->update($request->all());

        //handle file input for character_avatar
        if ($request->hasFile('character_avatar')) {
            $originalExtension = $request->file('character_avatar')->getClientOriginalExtension();
            $newFileName = 'avatar_' . $character->id . '.' . $originalExtension;
            $avatarPath = $request->file('character_avatar')->storeAs('avatars', $newFileName, 'public');
            $character->character_avatar = $avatarPath;
        }

        //handle file input for character_concept
        if ($request->hasFile('character_concept')) {
            $originalExtension = $request->file('character_concept')->getClientOriginalExtension();
            $newFileName = 'concept_' . $character->id . '.' . $originalExtension;
            $conceptPath = $request->file('character_concept')->storeAs('concepts', $newFileName, 'public');
            $character->character_concept = $conceptPath;
        }

        $character->save();

        return redirect()->route('characters.index')->with('success', 'Character updated successfully.');
    }

    public function destroy(Character $character)
    {
        $character->delete();

        return redirect()->route('characters.index')->with('success', 'Character deleted successfully.');
    }
}
