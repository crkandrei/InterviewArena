<template>
    <div class="tag-input">
        <ul class="tags" ref="tagsUl">
            <li v-for="(tag, index) in tags" :key="tag" class="tag">
                {{ tag }}
                <button class="delete" @click="removeTag(index)">x</button>
            </li>
        </ul>
        <input
            v-model="newTag"
            type="text"
            :style="{ 'padding-left': `${paddingLeft}px` }"
            @keydown.enter="addTag(newTag)"
            @keydown.prevent.tab="addTag(newTag)"
            @keydown.delete="newTag.length || removeTag(tags.length - 1)"
            placeholder="e.g., HTML, CSS"
            class="w-full p-2 border rounded-md"
        />
    </div>
</template>

<script setup>
import { ref, watch, nextTick, onMounted, defineProps } from 'vue';

const { modelValue, 'onUpdate:modelValue': modelUpdate } = defineProps();

const newTag = ref('');

const addTag = (tag) => {
    if(tag) modelUpdate([...modelValue, tag]);
    newTag.value = '';
};

const removeTag = (index) => {
    const newTags = [...modelValue];
    newTags.splice(index, 1);
    modelUpdate(newTags);
};

const onTagsChange = () => {
    const extraCushion = 15;
    paddingLeft.value = tagsUl.value.clientWidth + extraCushion;
    tagsUl.value.scrollTo(tagsUl.value.scrollWidth, 0);
};

watch(tags, () => nextTick(onTagsChange), { deep: true });
onMounted(onTagsChange);
</script>

<style scoped>
.tag-input {
    position: relative;
}

ul {
    list-style: none;
    display: flex;
    align-items: center;
    gap: 7px;
    margin: 0;
    padding: 0;
    position: absolute;
    top: 0;
    bottom: 0;
    left: 10px;
    max-width: 75%;
    overflow-x: auto;
}

.tag {
    background: rgb(250, 104, 104);
    padding: 5px;
    border-radius: 4px;
    color: white;
    white-space: nowrap;
    transition: 0.1s ease background;
}

.delete {
    color: white;
    background: none;
    outline: none;
    border: none;
    cursor: pointer;
}
</style>
