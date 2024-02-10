(function ($) {
    $(document).ready(function () {
        $("#select_post").on("change", function () {
            const val = $(this).val();
            $.get("/wp-json/aidream-wp/v1/meta?post_id=" + val, function (resp) {
                $("#meta_title").val(resp.title);
                $("#meta_desc").val(resp.description);

                // Clear existing dynamic content
                $(".dynamic-headings, .dynamic-images").remove();

                // Handle headings
                ["h1", "h2", "h3", "h4"].forEach(function (tag) {
                    if (resp[tag] && resp[tag].length > 0) {
                        resp[tag].forEach(function (content, index) {
                            const row = $("<tr>").addClass("form-field form-required dynamic-headings");
                            const labelTh = $("<th>").attr("scope", "row").append($("<label>").text(`${tag.toUpperCase()} (${index + 1})`));
                            const originalContentTd = $("<td>");
                            const ameContentTd = $("<td>");
                            const originalInput = $("<input>").attr({
                                type: "text",
                                id: `${tag}_${index + 1}`,
                                name: `${tag}[]`,
                                value: content,
                            });
                            const ameInput = $("<input>").attr({
                                type: "text",
                                id: `ame_${tag}_${index + 1}`,
                                name: `ame_${tag}[]`,
                                placeholder: "AI Matrix Engine Suggestion",
                            });
                            originalContentTd.append(originalInput);
                            ameContentTd.append(ameInput);
                            row.append(labelTh, originalContentTd, ameContentTd);
                            $("#headings-placeholder").before(row);
                        });
                    }
                });

                // Handle images
                console.log("Adding AME Image data...")
                if (resp.images && resp.images.length > 0) {
                    resp.images.forEach(function(image, index) {
                        // Insert image display row
                        const imageRow = $('<tr>').addClass('form-field form-required dynamic-images');
                        const imageTh = $('<th>').attr('scope', 'row').text(`Image ${index + 1}:`);
                        const imageDisplayTd = $('<td>').attr('colspan', 2).append($('<img>').attr({
                            src: image.src,
                            alt: image.alt || '',
                            style: 'max-width: 100px; max-height: 100px; display: block;'
                        }));
                        imageRow.append(imageTh, imageDisplayTd);
                        $('#images-placeholder').before(imageRow);

                        // Insert image details (src, alt, title)
                        ['src', 'alt', 'title'].forEach(function(attr) {
                            const detailRow = $('<tr>').addClass('form-field form-required dynamic-images');
                            const detailLabelTh = $('<th>').attr('scope', 'row').text(`${attr.toUpperCase()} ${index + 1}:`);
                            const originalContentTd = $('<td>');
                            const ameContentTd = $('<td>');
                            const originalInput = $('<input>').attr({
                                type: 'text',
                                id: `image_${attr}_${index + 1}`,
                                name: `image_${attr}[]`,
                                value: image[attr] || ''
                            });
                            const ameInput = $('<input>').attr({
                                type: 'text',
                                id: `ameImage_${attr}_${index + 1}`,
                                name: `ameImage_${attr}[]`,
                                placeholder: 'AI Matrix Engine Suggestion'
                            });
                            originalContentTd.append(originalInput);
                            ameContentTd.append(ameInput);
                            detailRow.append(detailLabelTh, originalContentTd, ameContentTd);
                            $('#images-placeholder').before(detailRow);
                        });
                    });
                }
            });
        });
    });
})(jQuery);
