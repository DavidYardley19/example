<div {{ $attributes->merge(['class' => 'flex items-center rounded-md bg-white pl-3 outline-1 -outline-offset-1 outline-gray-300 focus-within:outline-2 focus-within:-outline-offset-2 focus-within:outline-indigo-600']) }}>
    <div {{ $attributes->only(['icon-class', 'icon-id'])->merge(['class' => 'shrink-0 text-base text-gray-500 select-none sm:text-sm/6']) }}></div>
    <input {{ $attributes->except(['icon-class', 'icon-id'])->merge(['class' => 'block min-w-0 grow bg-white px-3 py-1.5 pr-3 pl-1 text-base text-gray-900 placeholder:text-gray-400 focus:outline-none sm:text-sm/6']) }} />
</div>
