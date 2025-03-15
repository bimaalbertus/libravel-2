 <div class="flex flex-col gap-8 p-4">
     <div
         class="flex flex-col border bg-white dark:bg-black/40 text-black dark:text-white border-black/30 dark:border-white/30 rounded-lg">
         <livewire:avatar />
     </div>

     <div
         class="flex flex-col border bg-white dark:bg-black/40 text-black dark:text-white border-black/30 dark:border-white/30 rounded-lg">
         @if ($user->isAdmin())
             <livewire:username-update />
         @else
             <livewire:username-request />
         @endif
     </div>

     <div
         class="flex flex-col border bg-white dark:bg-black/40 text-black dark:text-white border-black/30 dark:border-white/30 rounded-lg">
         <livewire:bio />
     </div>

     <div
         class="flex flex-col border bg-white dark:bg-black/40 text-black dark:text-white border-black/30 dark:border-white/30 rounded-lg">
         <livewire:fullname-update />
     </div>

     <div
         class="flex flex-col border bg-white dark:bg-black/40 text-black dark:text-white border-black/30 dark:border-white/30 rounded-lg">
         <livewire:browser-sessions />
     </div>
 </div>
