<?php

namespace Omnipress\Models;

class FormModel {
	private $method;
	private $action;

	/**
	 * Generates a form start tag.
	 */
	public function form_start() {
		return '<form action="' . $this->action . '" method="' . $this->method . '">';
	}

	/**
	 * Sets the form method.
	 */
	public function set_form_method( $method ) {
		$this->method = $method;
		return $this;
	}

	public function get_form_method() {
		return $this->method;
	}

	public function set_form_action( $action ) {
		$this->action = $action;
		return $this;
	}

	/**
	 * Generates an input.
	 */
	public function form_input( $name = 'text', $value = '', $type = 'text' ) {
		return '<input name="' . $name . '" value="' . esc_attr( $value ) . '" type="' . $type . '" id="' . $name . '" class="op-bg-gray-50 op-border op-border-gray-300 op-text-gray-900 op-text-sm op-rounded-lg focus:op-ring-blue-500 focus:op-border-blue-500 op-block op-w-full op-p-2.5 dark:op-bg-gray-700 dark:op-border-gray-600 dark:op-placeholder-gray-400 dark:op-text-white dark:focus:op-ring-blue-500 dark:focus:op-border-blue-500" placeholder="" required />';
	}

	public function form_input_with_label( $name = 'text', $value = '', $type = 'text', $label = 'Text' ) {
		return '<div class="op-mb-5">
				<label for="' . $name . '" class="op-block op-mb-2 op-text-sm op-font-medium op-text-gray-900 dark:op-text-white">' . $label . '</label>
				<input name="' . $name . '" value="' . esc_attr( $value ) . '" type="' . $type . '" id="' . $name . '" class="op-bg-gray-50 op-border op-border-gray-300 op-text-gray-900 op-text-sm op-rounded-lg focus:op-ring-blue-500 focus:op-border-blue-500 op-block op-w-full op-p-2.5 dark:op-bg-gray-700 dark:op-border-gray-600 dark:op-placeholder-gray-400 dark:op-text-white dark:focus:op-ring-blue-500 dark:focus:op-border-blue-500" placeholder="" required />
		</div>';
	}

	public function form_radio( $name, $value, $fields ) {
		$options = '';

		foreach ( $fields as $label => $field_name ) {
			$checked  = ( $field_name == esc_attr( $value ) ) ? 'checked' : '';
			$options .= '<div class="op-mb-5"><label for="' . $field_name . '" class="op-block op-mb-2 op-text-sm op-font-medium op-text-gray-900 dark:op-text-white">' . $label . '</label><input ' . $checked . ' type="radio" value="' . $field_name . '" id="' . $field_name . '" name="' . $name . '" class="op-bg-gray-50 op-border op-border-gray-300 op-text-gray-900 op-text-sm op-rounded-lg focus:op-ring-blue-500 focus:op-border-blue-500 op-block op-w-full op-p-2.5 dark:op-bg-gray-700 dark:op-border-gray-600 dark:op-placeholder-gray-400 dark:op-text-white dark:focus:op-ring-blue-500 dark:focus:op-border-blue-500" required /></div>';
		}

		return '<div class="op-flex op-items-center op-gap-5">' . $options . '</div>';
	}


	/**
	 * Generates a textarea.
	 */
	public function form_textarea( $name = '', $value = '' ) {
		return '<textarea rows="4" name="' . $name . '">' . $value . '</textarea>';
	}

	public function form_textarea_with_label( $name = '', $value = '', $label = 'Text' ) {
		return "<label for='$name' class='op-block op-mb-2 op-text-sm op-font-medium op-text-gray-900 op-dark:text-white'>$label</label><textarea id='$name' name='$name' rows='4' class='op-block op-p-2.5 op-w-full op-text-sm op-text-gray-900 op-bg-gray-50 op-rounded-lg op-border op-border-gray-300 op-focus:ring-blue-500 op-focus:border-blue-500 op-dark:bg-gray-700 op-dark:border-gray-600 op-dark:placeholder-gray-400 op-dark:text-white op-dark:focus:ring-blue-500 op-dark:focus:border-blue-500' required placeholder='Write your text ...'>$value</textarea>";
	}

	public function form_hidden( $name = '', $value = '' ) {
		return '<input type="hidden" name="' . $name . '" value="' . $value . '">';
	}


	/**
	 * Generates a checkbox.
	 */
	public function form_checkbox( $name = '', $checked = false, $label = '' ) {
		$checked = (bool) ( $checked ) ? 'checked' : '';

		return '<div class="op-flex op-items-center">
				<input ' . $checked . ' name="' . $name . '" id="' . $name . '" type="checkbox" class="op-w-4 op-h-4 op-text-blue-600 op-bg-gray-100 op-border-gray-300 op-rounded op-focus:op-ring-blue-500 dark:op-focus:op-ring-blue-600 dark:op-ring-offset-gray-800 op-focus:op-ring-2 dark:op-bg-gray-700 dark:op-border-gray-600">
				<label for="' . $name . '" class="op-ms-2 op-text-sm op-font-medium op-text-gray-900 dark:op-text-gray-300">' . $label . '</label>
			</div>';
	}


	/**
	 * Generates a submit button.
	 */
	public function form_submit( $value ) {
		return "<button type='submit' class='op-text-white op-bg-blue-700 hover:op-bg-blue-800 focus:op-ring-4 focus:op-outline-none focus:op-ring-blue-300 op-font-medium op-rounded-lg op-text-sm op-w-full sm:op-w-auto op-px-5 op-py-2.5 op-text-center dark:op-bg-blue-600 dark:hover:op-bg-blue-700 dark:focus:op-ring-blue-800'>$value</button>";
	}

	public function show_notification( $notification ) {

		if ( isset( $notification ) ) {
			$type    = $notification['type'];
			$message = $notification['message'];

			$notification_classes = array(
				'success' => 'op-bg-green-100 op-border-green-400 op-text-green-700 op-bg-opacity-50',
				'error'   => 'op-bg-red-100 op-border-red-400 op-text-red-700 op-bg-opacity-50',
			);

			$notification_class = isset( $notification_classes[ $type ] ) ? $notification_classes[ $type ] : '';

			echo '<p class="' . esc_attr( $notification_class ) . '">' . esc_html( $message ) . '</p>';
		}
	}

	/**
	 * Generates a form end tag.
	 */
	public function form_end() {
		return '</form>';
	}
}
