<!-- resources/views/voila.blade.php -->
<x-app-layout style="overflow: hidden; padding: 0; margin: 0;">
    <x-slot name="header" style="overflow: hidden; padding: 0; margin: 0;">
        <iframe src={{asset("jupyter/Ch03_linreg_lab.html")}} width="100%" height="775"></iframe>
    </x-slot>
</x-app-layout>