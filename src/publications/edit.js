/**
 * Retrieves the translation of text.
 *
 * @see https://developer.wordpress.org/block-editor/reference-guides/packages/packages-i18n/
 */
import { __ } from '@wordpress/i18n';

/**
 * React hook that is used to mark the block wrapper element.
 * It provides all the necessary props like the class name.
 *
 * @see https://developer.wordpress.org/block-editor/reference-guides/packages/packages-block-editor/#useblockprops
 */
import { useBlockProps } from '@wordpress/block-editor';
import { useEntityRecords } from '@wordpress/core-data';

/**
 * Lets webpack process CSS, SASS or SCSS files referenced in JavaScript files.
 * Those files can contain any CSS code that gets applied to the editor.
 *
 * @see https://www.npmjs.com/package/@wordpress/scripts#using-css
 */
import './editor.scss';

/**
 * The edit function describes the structure of your block in the context of the
 * editor. This represents what the editor will render when the block is used.
 *
 * @see https://developer.wordpress.org/block-editor/reference-guides/block-api/block-edit-save/#edit
 *
 * @return {Element} Element to render.
 */
export default function Edit() {

	const { records, hasResolved } = useEntityRecords( 'postType', 'prefix_publication', { per_page: 1 } );

	return (
		<div { ...useBlockProps() }>
			<p>{ __( 'Note: this is a partial preview. The frontend displays all content with different styles. This message is not visible on the frontend.', 'moare-blocks' ) }</p>
			<details>
				<summary>{ __( 'Year e.g. 2025', 'moare-blocks' ) }</summary>
				<ul>
				{records && (
				<>
					{records.map((record) => (
						<li key={record.id}>
							<span className="authors-publication">{record.acf.prefix_authors}</span>
							<span className="year-publication">{(record.acf.prefix_year)}</span>
							<span className="title-publication">{record.title.rendered}.</span>
							<span className="publishin-on ">{record.acf.prefix_publishing_on}</span>
							<span className="type"> {record.acf.prefix_type}.</span>
							{record.acf.prefix_external_link &&
								<span className="external-link-publication">
									<a href="#">{ __( 'External link', 'moare-blocks' ) }</a>.
								</span>
							}
						</li>
					))}
				</>
				)}
				</ul>
			</details>
			<details>
				<summary>2024</summary>
				<ul>
					<li>{ __( 'Authors (year) Title. Published on. Type. External link', 'moare-blocks' ) }</li>
				</ul>
			</details>
			<details>
				<summary>2023</summary>
				<ul>
					<li>{ __( 'Authors (year) Title. Published on. Type. External link', 'moare-blocks' ) }</li>
				</ul>
			</details>
			<details>
				<summary>…</summary>
				<ul>
					<li>{ __( 'Authors (year) Title. Published on. Type. External link', 'moare-blocks' ) }</li>
				</ul>
			</details>
		</div>
	);
}
