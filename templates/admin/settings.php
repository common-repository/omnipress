<?php
/**
 * @var bool $admin
 * @var bool $frontend
 * @var string $scriptType
 * @var string $scriptName
 * @var string $content
 * @var string $action
 * @var bool $addOnFooter
 * @var array $notification
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$asset_type_options = array(
	'JS'  => 'js',
	'CSS' => 'css',
);
$op_script_nonce    = wp_create_nonce( 'opcs_nonce' );
$form               = new \Omnipress\Models\FormModel();
?>

<div class="op-block__settings op-max-w-[83rem] op-w-full op-my-30px op-h-full op-my-30px op-bg-background op-mx-auto op-mt-5 op-p-6 op-grid op-gap-7 lg:op-grid-cols-3 op-grid-cols-1">

	<div class="op-p-5 op-border op-border-slate-300 op-rounded-lg">
			<fieldset>
				<h3 class="op-mb-4 op-leading-none op-tracking-tight op-text-gray-900 op-text-xl op-font-extrabold dark:op-text-white op-mt-6">
					Add Your (Scripts | CSS)
				</h3>

				<p class="op-text-sm op-font-normal op-text-gray-500 lg:op-text-md dark:op-text-gray-400 op-mb-4">
					You can add your scripts and css here.
				</p>
				<?php
					$html_output  = $form->form_hidden( 'action', 'opcs' );
					$html_output .= $form->form_hidden( 'opcs_nonce', $op_script_nonce );

					$html_output .= $form->form_input_with_label( 'scriptName', $scriptName ?? '', 'text', 'Script name' );
					$html_output .= '<div class="op-grid op-gap-3"><h3 class="op-mb-4 op-leading-none op-tracking-tight op-text-gray-900 op-text-xl op-font-extrabold dark:op-text-white op-mt-6">Options</h3>';

					$html_output .= $form->form_radio( 'scriptType', $assetType ?? 'js', $asset_type_options );

					$html_output .= '<div class="op-grid op-gap-3">	<h3 class="op-mb-4 op-leading-none op-tracking-tight op-text-gray-900 op-text-xl op-font-extrabold dark:op-text-white op-mt-6">	Where to add your (Scripts | CSS)</h3>';
					$html_output .= $form->form_checkbox( 'addOnFooter', $addOnFooter ?? true, 'Load Scripts On Footer' );
					$html_output .= $form->form_checkbox( 'admin', $admin ?? false, 'Enqueue On Admin' );
					$html_output .= $form->form_checkbox( 'frontend', $frontend ?? false, 'Enquque on frontend' );


					$html_output .= '</div>';

					$html_output .= $form->form_textarea_with_label( 'content', $content ?? '', 'Content' );
					$html_output .= $form->form_submit( 'Save' );

					echo $html_output;
				?>
			</fieldset>
		<?php
			echo $form->form_end();
		?>
	</div>

	<div class="op-p-5 op-border op-border-slate-300 op-rounded-lg op-col-span-2">
		<h3 class="op-mb-4 op-leading-none op-tracking-tight op-text-gray-900 op-text-2xl op-font-extrabold dark:op-text-white op-mt-6">
			Custom Scripts|CSS
		</h3>
		<p class="op-text-sm op-font-normal op-text-gray-500 lg:op-text-md dark:op-text-gray-400 op-mb-4">
			Here is the list of custom assets..
		</p>

		<div class="op-relative op-overflow-x-auto sm:op-rounded-lg">
			<table class="op-w-full op-text-sm op-text-left rtl:op-text-right op-text-gray-500 dark:op-text-gray-400">
				<thead class="op-text-xs op-text-gray-700 op-uppercase op-bg-gray-50 dark:op-bg-gray-700 dark:op-text-gray-400">
				<tr>
					<th scope="col" class="op-px-6 op-py-3">
						Scripts Name
					</th>
					<th scope="col" class="op-px-6 op-py-3">
						Type
					</th>
					<th scope="col" class="op-px-6 op-py-3">
						Load On Admin
					</th>
					<th scope="col" class="op-px-6 op-py-3">
						Load On Frontend
					</th>
					<th scope="col" class="op-px-6 op-py-3">
						Enqueue On
					</th>
					<th scope="col" class="op-px-6 op-py-3">
						Action
					</th>
				</tr>
				</thead>
				<tbody>
				<tr>
				<th scope="row" class="op-px-6 op-py-4 op-font-medium op-text-gray-900 op-whitespace-nowrap dark:op-text-white">
					name
				</th>
				<td class="op-px-6 op-py-4">
					type
				</td>
				<td class="op-px-6 op-py-4">
					show on admin
				</td>
				<td class="op-px-6 op-py-4">
					yes
				</td>
				<td class="op-px-6 op-py-4">
					no
				</td>
				<td class="op-px-6 op-py-4">
					<a href="#" class="op-font-medium op-text-blue-600 dark:op-text-blue-500 op-hover:op-underline">Edit</a>
				</td>
				</tr>
				</tbody>
			</table>
		</div>
	</div>
</div>



