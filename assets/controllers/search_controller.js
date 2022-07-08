import { Controller } from '@hotwired/stimulus';
import algoliasearch from 'algoliasearch/lite';
import instantsearch from 'instantsearch.js';
import { searchBox, hits, pagination, hitsPerPage } from 'instantsearch.js/es/widgets';

export default class extends Controller {
    static values = {
        path: String,
    }

    connect() {
        const searchClient = algoliasearch(process.env.ALGOLIA_APP_ID, process.env.ALGOLIA_API_KEY);

        this.search = instantsearch({
            indexName: 'post',
            searchClient,
        });

        this.search.addWidgets([
            searchBox({
                container: "#searchbox",
                showSubmit: false,
                showReset: false,
                cssClasses: {
                    input: 'form-control',
                    form: 'form-group',
                },
                placeholder: 'Search',
            }),

            hits({
                container: "#hits",
                templates: {
                    item: (item) => {
                        const document = (new DOMParser()).parseFromString(item.description, 'text/html');

                        return `<a class="post-link" target="_blank" href="${ this.pathValue.replaceAll('slug', item.slug) }">
                            <div class="post">
                                <h2 class="post__title">${ item.title }</h2>
                                <div class="post__meta">
                                    <span><i class="fa-solid fa-folder-open"></i>
                                        ${ item.category }
                                    </span>
                                    <span><i class="fa-solid fa-clock"></i> ${ (new Date(item.publicationAt.date)).toLocaleDateString() }</span>
                                </div>
                                <p class="post__description">${ document.body.innerHTML }</p>
                            </div>
                        </a>`
                    },
                    empty: `No results for <q>{{ query }}</q>`,
                },
            }),

            hitsPerPage({
                container: '#hits-per-page',
                items: [
                    { label: '10 posts per page', value: 10 },
                    { label: '20 posts per page', value: 20, default: true },
                    { label: '50 posts per page', value: 50 },
                ],
                cssClasses: {
                    root: 'form-group',
                    select: 'form-control',
                }
            }),

            pagination({
                container: '#pagination',
                cssClasses: {
                    list: 'pagination',
                    item: 'page-item',
                    link: 'page-link'
                },
                showNext: true,
                showPrevious: true,
                padding: 2,
            }),
        ]);

        this.search.start();
    }
}
