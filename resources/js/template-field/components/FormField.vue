<template>
	<default-field :field="field" :errors="errors">
		<template slot="field">
			<select
				name="template"
				class="w-full form-control form-input form-input-bordered"
				v-model="template"
				:disabled="hasParentResourceTemplate"
			>
				<option value="">Choose a template</option>
				<option
					:value="template.value"
					v-for="template in field.templates"
					:key="template.value"
					>{{ template.label }}</option
				>
			</select>
		</template>
	</default-field>
</template>

<script>
import { FormField, HandlesValidationErrors } from "laravel-nova";
import { getParameterByName } from "../../util";

export default {
	mixins: [FormField, HandlesValidationErrors],

	props: ["resourceName", "resourceId", "field"],

	data() {
		return {
			template: void 0
		};
	},

	computed: {
		hasParentResourceTemplate() {
			if (this.field.value) return true;
			return false;
		}
	},

	methods: {
		setInitialValue() {
			this.template = this.field.value;
		},

		fill(formData) {
			if (this.template)
				formData.append(this.field.attribute, this.template);
		}
	}
};
</script>
