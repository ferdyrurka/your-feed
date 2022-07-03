import { Controller } from '@hotwired/stimulus';
import algoliasearch from 'algoliasearch/lite';
import instantsearch from 'instantsearch.js';
import { searchBox, hits, pagination } from 'instantsearch.js/es/widgets';

export default class extends Controller {
    static values = {
        path: String,
    }

    connect() {
        const searchClient = algoliasearch('QORFSY1B95', '3bbe493def8bf9a8b07be8542bd3219c');

        this.search = instantsearch({
            indexName: 'post',
            searchClient,
        });

        this.search.addWidgets([
            searchBox({
                container: "#searchbox",
            }),

            hits({
                container: "#hits",
                templates: {
                    item: `
                        <a class="post-link" target="_blank" href="{{ this.pathValue.replaceAll('%slug%', slug) }}">
                            <div class="post">
                                <h2 class="post__title">{{ title }}</h2>
                                <div class="post__meta">
                                    <span><i class="fa-solid fa-folder-open"></i> {{ category }}</span>
                                    <span><i class="fa-solid fa-clock"></i> {{ publicationAt }}</span>
                                </div>
                                <p class="post__description">{{ description }}</p>
                            </div>
                        </a>
                      `,
                },
            }),

            pagination({
                container: '#pagination',
            }),
        ]);

        this.search.start();
    }
}
