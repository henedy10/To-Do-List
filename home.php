<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>To‑Do List • Home</title>
  <!-- Tailwind CSS via CDN -->
  <script src="https://cdn.tailwindcss.com"></script>
  <script>
    // Tailwind config (optional) for nicer default font
    tailwind.config = {
      theme: {
        extend: {
          fontFamily: {
            sans: ["Inter", "system-ui", "-apple-system", "Segoe UI", "Roboto", "Ubuntu", "Cantarell", "Noto Sans", "Helvetica Neue", "Arial", "sans-serif"],
          }
        }
      }
    }
  </script>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
  <style>
    /* Simple transition helpers */
    .fade-enter { opacity: 0; transform: translateY(4px); }
    .fade-enter-active { opacity: 1; transform: translateY(0); transition: all .18s ease; }
    .fade-leave { opacity: 1; transform: translateY(0); }
    .fade-leave-active { opacity: 0; transform: translateY(4px); transition: all .14s ease; }
  </style>
</head>
<body class="bg-gray-50 text-gray-900">
  <!-- Page container -->
  <div class="min-h-screen">
    <!-- Top bar -->
    <header class="sticky top-0 z-30 bg-white/90 backdrop-blur border-b border-gray-200">
      <div class="max-w-6xl mx-auto px-4 sm:px-6">
        <div class="h-16 flex items-center justify-between gap-4">
          <div class="flex items-center gap-3">
            <div class="size-9 grid place-items-center rounded-xl bg-indigo-600 text-white shadow-sm">
              <!-- check icon -->
              <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-5">
                <path fill-rule="evenodd" d="M2.25 12c0-5.385 4.365-9.75 9.75-9.75s9.75 4.365 9.75 9.75-4.365 9.75-9.75 9.75S2.25 17.385 2.25 12Zm13.36-2.59a.75.75 0 0 1 1.06 1.06l-5.25 5.25a.75.75 0 0 1-1.06 0l-2.25-2.25a.75.75 0 1 1 1.06-1.06l1.72 1.72 4.72-4.72Z" clip-rule="evenodd" />
              </svg>
            </div>
            <span class="text-lg font-semibold tracking-tight">To‑Do List</span>
          </div>

          <!-- Search -->
          <div class="flex-1 hidden md:flex">
            <form action="#" method="GET" class="w-full">
              <label class="relative block">
                <span class="sr-only">Search tasks</span>
                <span class="absolute inset-y-0 left-0 flex items-center pl-3">
                  <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-5 text-gray-400">
                    <path fill-rule="evenodd" d="M10.5 3.75a6.75 6.75 0 1 0 4.17 12.06l4.26 4.26a.75.75 0 1 0 1.06-1.06l-4.26-4.26A6.75 6.75 0 0 0 10.5 3.75Zm-5.25 6.75a5.25 5.25 0 1 1 10.5 0 5.25 5.25 0 0 1-10.5 0Z" clip-rule="evenodd" />
                  </svg>
                </span>
                <input name="q" class="w-full rounded-xl border border-gray-200 bg-white h-10 pl-10 pr-3 text-sm placeholder:text-gray-400 focus:outline-none focus:ring-4 focus:ring-indigo-100 focus:border-indigo-500" placeholder="Search tasks, labels, assignees…" />
              </label>
            </form>
          </div>

          <!-- User menu -->
          <div class="flex items-center gap-3">
            <button id="btnNewTask" class="hidden sm:inline-flex items-center gap-2 rounded-xl bg-indigo-600 text-white px-3.5 py-2.5 text-sm font-medium shadow hover:bg-indigo-700 focus:outline-none focus:ring-4 focus:ring-indigo-100">
              <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-4"><path d="M12 3.75a.75.75 0 0 1 .75.75v6.75h6.75a.75.75 0 0 1 0 1.5H12.75v6.75a.75.75 0 0 1-1.5 0V12.75H4.5a.75.75 0 0 1 0-1.5h6.75V4.5A.75.75 0 0 1 12 3.75Z"/></svg>
              New Task
            </button>
            <div class="h-6 w-px bg-gray-200"></div>
            <div class="flex items-center gap-2">
              <span class="hidden sm:block text-sm text-gray-600">Hi, Ahmed</span>
              <img src="https://i.pravatar.cc/64?u=ahmed" class="size-8 rounded-xl" alt="User" />
            </div>
          </div>
        </div>
      </div>
    </header>

    <!-- Content -->
    <main class="max-w-6xl mx-auto px-4 sm:px-6 py-6">
      <!-- Toolbar: filters, tabs, counters -->
      <div class="flex flex-col sm:flex-row sm:items-center gap-3 sm:gap-4 mb-5">
        <!-- Tabs -->
        <div class="flex items-center gap-1 p-1 rounded-xl bg-white border border-gray-200 shadow-sm">
          <button data-filter="all" class="tab-btn px-3 py-1.5 rounded-lg text-sm font-medium text-gray-700 hover:bg-gray-100 aria-selected:bg-indigo-600 aria-selected:text-white" aria-selected="true">All</button>
          <button data-filter="active" class="tab-btn px-3 py-1.5 rounded-lg text-sm font-medium text-gray-700 hover:bg-gray-100">Active</button>
          <button data-filter="completed" class="tab-btn px-3 py-1.5 rounded-lg text-sm font-medium text-gray-700 hover:bg-gray-100">Completed</button>
          <button data-filter="today" class="tab-btn px-3 py-1.5 rounded-lg text-sm font-medium text-gray-700 hover:bg-gray-100">Today</button>
        </div>

        <!-- Labels filter -->
        <div class="flex items-center gap-2">
          <select id="labelFilter" class="rounded-xl border border-gray-200 bg-white h-10 px-3 text-sm focus:outline-none focus:ring-4 focus:ring-indigo-100 focus:border-indigo-500">
            <option value="">All labels</option>
            <option value="work">Work</option>
            <option value="personal">Personal</option>
            <option value="study">Study</option>
          </select>
          <select id="priorityFilter" class="rounded-xl border border-gray-200 bg-white h-10 px-3 text-sm focus:outline-none focus:ring-4 focus:ring-indigo-100 focus:border-indigo-500">
            <option value="">Any priority</option>
            <option value="high">High</option>
            <option value="medium">Medium</option>
            <option value="low">Low</option>
          </select>
        </div>

        <div class="flex-1"></div>

        <!-- Bulk actions -->
        <div class="flex items-center gap-2">
          <button id="btnCompleteSelected" class="rounded-xl border border-gray-200 bg-white px-3.5 py-2 text-sm font-medium hover:bg-gray-50">Complete Selected</button>
          <button id="btnDeleteSelected" class="rounded-xl bg-red-50 text-red-700 px-3.5 py-2 text-sm font-medium border border-red-200 hover:bg-red-100">Delete</button>
        </div>
      </div>

      <!-- Add task input (mobile friendly) -->
      <div class="bg-white border border-gray-200 rounded-2xl shadow-sm p-3 sm:p-4 mb-4">
        <form id="newTaskForm" class="flex flex-col sm:flex-row gap-3">
          <input id="taskTitle" class="flex-1 rounded-xl border border-gray-200 bg-white h-11 px-3 text-sm placeholder:text-gray-400 focus:outline-none focus:ring-4 focus:ring-indigo-100 focus:border-indigo-500" placeholder="Add a new task… e.g. “Finish hotel booking module”" required />
          <input id="taskDue" type="date" class="rounded-xl border border-gray-200 bg-white h-11 px-3 text-sm focus:outline-none focus:ring-4 focus:ring-indigo-100 focus:border-indigo-500" />
          <select id="taskPriority" class="rounded-xl border border-gray-200 bg-white h-11 px-3 text-sm focus:outline-none focus:ring-4 focus:ring-indigo-100 focus:border-indigo-500">
            <option value="low">Low</option>
            <option value="medium" selected>Medium</option>
            <option value="high">High</option>
          </select>
          <select id="taskLabel" class="rounded-xl border border-gray-200 bg-white h-11 px-3 text-sm focus:outline-none focus:ring-4 focus:ring-indigo-100 focus:border-indigo-500">
            <option value="">No label</option>
            <option value="work">Work</option>
            <option value="personal">Personal</option>
            <option value="study">Study</option>
          </select>
          <button class="rounded-xl bg-indigo-600 text-white px-4 py-2.5 text-sm font-medium shadow hover:bg-indigo-700 focus:outline-none focus:ring-4 focus:ring-indigo-100" type="submit">Add Task</button>
        </form>
      </div>

      <!-- Task list -->
      <section id="taskList" class="space-y-3">
        <!-- JS will render tasks here -->
      </section>

      <!-- Empty state -->
      <div id="emptyState" class="hidden">
        <div class="mt-10 bg-white border border-gray-200 rounded-2xl shadow-sm p-10 text-center">
          <div class="mx-auto w-12 h-12 rounded-2xl bg-indigo-100 text-indigo-600 grid place-items-center mb-3">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6"><path fill-rule="evenodd" d="M3 5.25A2.25 2.25 0 0 1 5.25 3h6.508a2.25 2.25 0 0 1 1.59.659l4.493 4.493a2.25 2.25 0 0 1 .659 1.59V18.75A2.25 2.25 0 0 1 16.25 21H5.25A2.25 2.25 0 0 1 3 18.75V5.25Zm9.75 6a.75.75 0 0 0-1.5 0v2.25H9a.75.75 0 0 0 0 1.5h2.25V17a.75.75 0 0 0 1.5 0v-2.25H15a.75.75 0 0 0 0-1.5h-2.25V11.25Z" clip-rule="evenodd"/></svg>
          </div>
          <h3 class="text-lg font-semibold">No tasks yet</h3>
          <p class="text-gray-600 text-sm">Create your first task to get started.</p>
        </div>
      </div>
    </main>
  </div>

  <!-- Edit modal -->
  <div id="editModal" class="hidden fixed inset-0 z-50 items-center justify-center">
    <div class="absolute inset-0 bg-black/30"></div>
    <div class="relative bg-white w-full max-w-lg mx-4 rounded-2xl border border-gray-200 shadow-xl p-5">
      <div class="flex items-center justify-between mb-3">
        <h3 class="text-base font-semibold">Edit Task</h3>
        <button class="size-9 grid place-items-center rounded-xl hover:bg-gray-100" data-action="closeModal" aria-label="Close">
          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" class="size-5"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M6 18 18 6M6 6l12 12"/></svg>
        </button>
      </div>
      <form id="editForm" class="space-y-3">
        <input type="hidden" id="editId" />
        <div>
          <label class="block text-sm font-medium mb-1">Title</label>
          <input id="editTitle" class="w-full rounded-xl border border-gray-200 bg-white h-11 px-3 text-sm focus:outline-none focus:ring-4 focus:ring-indigo-100 focus:border-indigo-500" required />
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-3">
          <div>
            <label class="block text-sm font-medium mb-1">Due</label>
            <input id="editDue" type="date" class="w-full rounded-xl border border-gray-200 bg-white h-11 px-3 text-sm focus:outline-none focus:ring-4 focus:ring-indigo-100 focus:border-indigo-500" />
          </div>
          <div>
            <label class="block text-sm font-medium mb-1">Priority</label>
            <select id="editPriority" class="w-full rounded-xl border border-gray-200 bg-white h-11 px-3 text-sm focus:outline-none focus:ring-4 focus:ring-indigo-100 focus:border-indigo-500">
              <option value="low">Low</option>
              <option value="medium">Medium</option>
              <option value="high">High</option>
            </select>
          </div>
          <div>
            <label class="block text-sm font-medium mb-1">Label</label>
            <select id="editLabel" class="w-full rounded-xl border border-gray-200 bg-white h-11 px-3 text-sm focus:outline-none focus:ring-4 focus:ring-indigo-100 focus:border-indigo-500">
              <option value="">No label</option>
              <option value="work">Work</option>
              <option value="personal">Personal</option>
              <option value="study">Study</option>
            </select>
          </div>
        </div>
        <div class="flex items-center justify-end gap-2 pt-1">
          <button type="button" data-action="closeModal" class="rounded-xl border border-gray-200 bg-white px-4 py-2.5 text-sm font-medium hover:bg-gray-50">Cancel</button>
          <button class="rounded-xl bg-indigo-600 text-white px-4 py-2.5 text-sm font-medium hover:bg-indigo-700">Save</button>
        </div>
      </form>
    </div>
  </div>

  <!-- Template for a task card -->
  <template id="taskItemTpl">
    <article class="task-item bg-white border border-gray-200 rounded-2xl shadow-sm p-4 flex items-start gap-3">
      <input type="checkbox" class="task-check mt-1.5 size-5 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500" />
      <div class="flex-1 min-w-0">
        <div class="flex flex-wrap items-center gap-2">
          <h4 class="task-title font-medium text-gray-900 truncate"></h4>
          <span class="task-label hidden text-[11px] px-2 py-0.5 rounded-full bg-gray-100 text-gray-700"></span>
          <span class="task-priority text-[11px] px-2 py-0.5 rounded-full"></span>
          <span class="task-due text-[11px] px-2 py-0.5 rounded-full bg-blue-50 text-blue-700 hidden"></span>
        </div>
        <p class="task-meta text-xs text-gray-500 mt-1"></p>
      </div>
      <div class="flex items-center gap-1">
        <button class="btn-edit size-9 grid place-items-center rounded-xl hover:bg-gray-100" title="Edit">
          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" class="size-5"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16.862 4.487a2.109 2.109 0 1 1 2.981 2.982L7.5 19.813 3 21l1.188-4.5L16.862 4.487Z"/></svg>
        </button>
        <button class="btn-delete size-9 grid place-items-center rounded-xl hover:bg-red-50 text-red-600" title="Delete">
          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" class="size-5"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M6 7.5h12M9.75 7.5v9.75m4.5-9.75v9.75M9 4.5h6a1.5 1.5 0 0 1 1.5 1.5v.75H7.5V6A1.5 1.5 0 0 1 9 4.5Zm9 3v12A2.25 2.25 0 0 1 15.75 21h-7.5A2.25 2.25 0 0 1 6 19.5v-12"/></svg>
        </button>
      </div>
    </article>
  </template>

  <script>
    // --- Simple demo logic (frontend only). Replace with your PHP endpoints later ---
    const $ = (s, el=document) => el.querySelector(s);
    const $$ = (s, el=document) => Array.from(el.querySelectorAll(s));

    const taskListEl = $('#taskList');
    const emptyStateEl = $('#emptyState');

    // In-memory state for demo. Replace with server data.
    let tasks = [
      { id: 1, title: 'Finish booking API endpoints', label: 'work', priority: 'high', due: todayPlus(0), completed: false, createdAt: Date.now()-3600e3 },
      { id: 2, title: 'Write README for project', label: 'study', priority: 'medium', due: todayPlus(2), completed: false, createdAt: Date.now()-7200e3 },
      { id: 3, title: 'Gym 45 min', label: 'personal', priority: 'low', due: '', completed: true, createdAt: Date.now()-86400e3 },
    ];

    function todayPlus(n){
      const d = new Date(); d.setDate(d.getDate()+n); return d.toISOString().slice(0,10);
    }

    function render(){
      taskListEl.innerHTML = '';
      const activeFilter = $('.tab-btn[aria-selected="true"]').dataset.filter;
      const labelFilter = $('#labelFilter').value;
      const priorityFilter = $('#priorityFilter').value;

      const filtered = tasks.filter(t => {
        if(labelFilter && t.label !== labelFilter) return false;
        if(priorityFilter && t.priority !== priorityFilter) return false;
        if(activeFilter === 'active' && t.completed) return false;
        if(activeFilter === 'completed' && !t.completed) return false;
        if(activeFilter === 'today'){
          const today = new Date().toISOString().slice(0,10);
          if(t.due !== today) return false;
        }
        return true;
      });

      emptyStateEl.classList.toggle('hidden', filtered.length !== 0);

      filtered.forEach(task => {
        const node = document.importNode($('#taskItemTpl').content, true);
        const root = node.querySelector('.task-item');
        root.dataset.id = task.id;

        const title = node.querySelector('.task-title');
        title.textContent = task.title;
        if(task.completed){ title.classList.add('line-through','text-gray-400'); }

        const label = node.querySelector('.task-label');
        if(task.label){
          label.textContent = capitalize(task.label);
          label.classList.remove('hidden');
        }

        const pr = node.querySelector('.task-priority');
        pr.textContent = cap(task.priority);
        pr.classList.add(priorityBadge(task.priority).bg, priorityBadge(task.priority).text);

        const due = node.querySelector('.task-due');
        if(task.due){
          const { text, late } = dueText(task.due);
          due.textContent = text;
          due.classList.toggle('hidden', false);
          if(late){ due.classList.remove('bg-blue-50','text-blue-700'); due.classList.add('bg-red-50','text-red-700'); }
        }

        node.querySelector('.task-meta').textContent = `Created ${timeAgo(task.createdAt)}`;

        // checkbox
        const cb = node.querySelector('.task-check');
        cb.checked = !!task.completed;
        cb.addEventListener('change', () => {
          task.completed = cb.checked;
          render();
          // TODO: send to server: POST /tasks/:id/toggle
        });

        // edit
        node.querySelector('.btn-edit').addEventListener('click', () => openEdit(task));

        // delete
        node.querySelector('.btn-delete').addEventListener('click', () => {
          if(confirm('Delete this task?')){
            tasks = tasks.filter(t => t.id !== task.id);
            render();
            // TODO: DELETE /tasks/:id
          }
        });

        taskListEl.appendChild(node);
      });
    }

    function cap(s){ return s ? s[0].toUpperCase()+s.slice(1) : s; }
    function capitalize(s){ return cap(s); }

    function priorityBadge(p){
      switch(p){
        case 'high': return { bg: 'bg-red-50', text: 'text-red-700' };
        case 'medium': return { bg: 'bg-amber-50', text: 'text-amber-700' };
        default: return { bg: 'bg-emerald-50', text: 'text-emerald-700' };
      }
    }

    function dueText(dateStr){
      const today = new Date();
      const due = new Date(dateStr);
      const diff = Math.floor((due - new Date(today.toDateString()))/86400000);
      if(diff === 0) return { text: 'Due today', late: false };
      if(diff === 1) return { text: 'Due tomorrow', late: false };
      if(diff < 0) return { text: `Overdue ${Math.abs(diff)}d`, late: true };
      return { text: `Due in ${diff}d`, late: false };
    }

    function timeAgo(ts){
      const s = Math.floor((Date.now()-ts)/1000);
      if(s<60) return `${s}s ago`;
      const m = Math.floor(s/60); if(m<60) return `${m}m ago`;
      const h = Math.floor(m/60); if(h<24) return `${h}h ago`;
      const d = Math.floor(h/24); return `${d}d ago`;
    }

    // Tabs
    $$('.tab-btn').forEach(btn => {
      btn.addEventListener('click', () => {
        $$('.tab-btn').forEach(b => b.setAttribute('aria-selected','false'));
        btn.setAttribute('aria-selected','true');
        render();
      });
    });

    // Filters
    $('#labelFilter').addEventListener('change', render);
    $('#priorityFilter').addEventListener('change', render);

    // New Task
    $('#newTaskForm').addEventListener('submit', (e) => {
      e.preventDefault();
      const title = $('#taskTitle').value.trim();
      if(!title) return;
      const task = {
        id: tasks.length ? Math.max(...tasks.map(t=>t.id))+1 : 1,
        title,
        label: $('#taskLabel').value,
        priority: $('#taskPriority').value,
        due: $('#taskDue').value,
        completed: false,
        createdAt: Date.now()
      };
      tasks.unshift(task);
      e.target.reset();
      render();
      // TODO: POST /tasks
    });

    // Bulk actions
    $('#btnCompleteSelected').addEventListener('click', () => {
      const ids = selectedIds();
      tasks = tasks.map(t => ids.includes(t.id) ? { ...t, completed: true } : t);
      render();
      // TODO: POST /tasks/bulk-complete
    });

    $('#btnDeleteSelected').addEventListener('click', () => {
      const ids = selectedIds();
      if(!ids.length) return;
      if(confirm(`Delete ${ids.length} selected task(s)?`)){
        tasks = tasks.filter(t => !ids.includes(t.id));
        render();
        // TODO: POST /tasks/bulk-delete
      }
    });

    function selectedIds(){
      return $$('.task-item').filter(row => row.querySelector('.task-check').checked).map(row => +row.dataset.id);
    }

    // Modal
    const modal = $('#editModal');
    function openEdit(task){
      $('#editId').value = task.id;
      $('#editTitle').value = task.title;
      $('#editDue').value = task.due || '';
      $('#editPriority').value = task.priority;
      $('#editLabel').value = task.label || '';
      modal.classList.remove('hidden');
      modal.classList.add('flex');
    }
    function closeEdit(){ modal.classList.add('hidden'); modal.classList.remove('flex'); }
    $$('[data-action="closeModal"]').forEach(btn => btn.addEventListener('click', closeEdit));
    modal.addEventListener('click', (e) => { if(e.target === modal) closeEdit(); });

    $('#editForm').addEventListener('submit', (e) => {
      e.preventDefault();
      const id = +$('#editId').value;
      const idx = tasks.findIndex(t => t.id === id);
      if(idx>-1){
        tasks[idx] = {
          ...tasks[idx],
          title: $('#editTitle').value.trim(),
          due: $('#editDue').value,
          priority: $('#editPriority').value,
          label: $('#editLabel').value
        };
        render();
        closeEdit();
        // TODO: PUT /tasks/:id
      }
    });

    // Keyboard: N for new task
    document.addEventListener('keydown', (e) => {
      if(e.key.toLowerCase()==='n' && (e.ctrlKey || e.metaKey)){
        $('#taskTitle').focus();
        e.preventDefault();
      }
    });

    // Init
    render();
  </script>
</body>
</html>
