import React from 'react';
import Pagination from '../Pagination';
import SearchResult from '../search/SearchResult';
import SearchTopInput from '../search/SearchTopInput';

function LayoutSearch(props) {
    const {
        results,
        currentSearchTerm,
        postType,
        posts,
        acfData,
        postsPerRow,
        currentPage,
        maxPages,
        loading,
        paginationStyle,

        pageNext,
        pagePrev,
        setCurrentPage,

        searchFieldChange,
        scrollUp,
    } = props;

    const loadingClass = loading ? 'loading-active' : '';
    let postItems = '';

    if (posts && posts.length > 0) {
        postItems = posts.map((post, index) => {
            return <SearchResult postType={postType} post={post} key={index} />;
        });
    }

    let postsContent;
    let quickLinks;
    let paginationContent;
    let resultsString;

    if (paginationStyle === 'more') {
        paginationContent = (
            <LoadMore
                currentPage={currentPage}
                maxPages={maxPages}
                pageNext={pageNext}
                pagePrev={pagePrev}
                setCurrentPage={setCurrentPage}
                scrollUp={scrollUp}
            ></LoadMore>
        );
    } else if (paginationStyle === 'pagination') {
        paginationContent = (
            <Pagination
                currentPage={currentPage}
                maxPages={maxPages}
                pageNext={pageNext}
                pagePrev={pagePrev}
                setCurrentPage={setCurrentPage}
                scrollUp={scrollUp}
            ></Pagination>
        );
    }

    if (posts && posts.length > 0) {
        postsContent = (
            <div className="eight29-posts-wrapper">
                <div
                    className={`eight29-posts ${loadingClass}`}
                    style={postsPerRow}
                >
                    {postItems}
                </div>

                {paginationContent}
            </div>
        );
    } else {
        if (!loading) {
            postsContent = (
                <div className="no-results">
                    { acfData.acf_search &&
                    <div className="no-results-wrapper" dangerouslySetInnerHTML={{ __html: acfData.acf_search['serach_no_results_info'] }}/>
                    }

                </div>
            );
        }
    }

    if(acfData.acf_search && acfData.acf_search['search_quick_links']) {
        quickLinks = <div className="quick-links">
            <p className="quick-links__title"dangerouslySetInnerHTML={{__html: acfData.acf_search['search_menu_title']}}/>
            <nav className="quick-links__menu" dangerouslySetInnerHTML={{__html: acfData.acf_search['search_quick_links']}}/>
        </div>

    }

    if(posts && posts.length > 0) {
        resultsString = results === 1 ? `${results} result` : `${results} results`;
        resultsString += ` for "${currentSearchTerm}"`;
    } else {
        resultsString = `0 results for "${currentSearchTerm}"`;
    }


    return (
        <div className="app-layout layout-search">
            <div className="container">
                <div className="row justify-content-center">
                    <div className="col-12 col-lg-8">
                        <SearchTopInput
                            currentSearchTerm={currentSearchTerm}
                            searchFieldChange={searchFieldChange}

                        ></SearchTopInput>
                    </div>
                </div>
            </div>
            <section className="eight29-posts-container">
                <div className="eight29-posts-container-wrapper">
                    <div className="container">
                        <div className="row">
                            <div className="col-12 col-lg-8">
                                <p className="search-results-info">{resultsString}</p>
                                {postsContent}
                            </div>
                            <div className="col-12 col-lg-3 offset-lg-1 offset-xl-2 col-xl-2">{quickLinks}</div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    );
}

export default LayoutSearch;
