<template>
  <div class="min-h-screen flex items-center justify-center bg-gradient-to-br from-blue-50 to-indigo-100 py-10">
    <div class="w-full max-w-xl bg-white/90 shadow-2xl rounded-2xl p-8 border border-gray-100">
      <div class="flex items-center gap-3 mb-6">
        <span class="text-3xl">✍️</span>
        <h2 class="text-3xl font-extrabold text-gray-800">مساعد كتابة المحتوى الذكي</h2>
      </div>
      <form @submit.prevent="handleSubmit" class="space-y-6">
        <div>
          <label for="topic" class="block mb-2 text-gray-700 font-medium">الموضوع</label>
          <input
            type="text"
            id="topic"
            v-model="form.topic"
            class="w-full border border-gray-300 focus:border-indigo-400 focus:ring-2 focus:ring-indigo-100 rounded-lg p-3 transition outline-none text-gray-800 placeholder-gray-400 shadow-sm"
            placeholder="أدخل موضوعك هنا..."
            required
          />
        </div>
        <div>
          <label for="type" class="block mb-2 text-gray-700 font-medium">نوع المحتوى</label>

            <select
                id="type"
                v-model="form.type"
                class="appearance-none w-full border border-gray-300 focus:border-indigo-400 focus:ring-2 focus:ring-indigo-100 rounded-lg p-3 transition outline-none text-gray-800 shadow-sm pr-10"
                dir="rtl"
                required
            >
                <option value="مقال">مقال</option>
                <option value="منشور إنستغرام">منشور إنستغرام</option>
                <option value="وصف منتج">وصف منتج</option>
            </select>
        </div>
        <button
          type="submit"
          class="w-full flex items-center justify-center gap-2 bg-gradient-to-r from-indigo-500 to-blue-500 text-white font-bold py-3 rounded-lg shadow-lg hover:from-indigo-600 hover:to-blue-600 transition disabled:opacity-60 disabled:cursor-not-allowed text-lg"
          :disabled="form.processing"
        >
          <svg v-if="form.processing" class="animate-spin h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8z"></path></svg>
          <span>توليد المحتوى</span>
        </button>
      </form>
      <transition name="fade">
        <div v-if="generatedContent" class="mt-8">
          <div class="flex items-center gap-2 mb-3">
            <span class="text-green-500 text-2xl">✅</span>
            <h3 class="text-xl font-semibold text-gray-700">المحتوى المولد</h3>
          </div>
          <div class="bg-gray-50 border border-gray-200 p-5 rounded-lg shadow-inner whitespace-pre-wrap text-gray-900 leading-relaxed text-lg">
            {{ generatedContent }}
          </div>
        </div>
      </transition>
    </div>
  </div>
</template>

<script setup>
import { ref } from 'vue';
import { router, useForm } from '@inertiajs/vue3';

const props = defineProps({
  generatedContent: String,
  topic: String,
  type: String,
});

const form = useForm({
  topic: props.topic || '',
  type: props.type || 'مقال',
});

const handleSubmit = () => {
  form.post('/generate');
};
</script>

<style scoped>
body {
  direction: rtl;
}
.fade-enter-active, .fade-leave-active {
  transition: opacity 0.4s;
}
.fade-enter-from, .fade-leave-to {
  opacity: 0;
}
</style>
