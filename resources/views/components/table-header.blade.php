<thead>
  <tr {{ $attributes->merge(['class' => 'border-b border-gray-100 text-left text-xs font-medium uppercase tracking-wider text-gray-400 dark:border-gray-800 dark:text-gray-500']) }}>
    {{ $slot }}
  </tr>
</thead>
